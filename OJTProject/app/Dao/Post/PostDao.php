<?php

namespace App\Dao\Post;

use App\Models\Post;
use App\Contract\Dao\Post\PostDaoInterface;

class PostDao implements PostDaoInterface
{
	/**
	 * store collect data
	 */
	public function storeCollectData($data)
	{
		if (!isset($data['created_user_id'])) 
		{
      $data['created_user_id'] = auth()->user()->id;
      Post::create($data);
      request()->session()->forget('post');
    } 
		else 
		{
      Post::create($data);
    }
	}

	/**
	 * get post list
	 */
	public function getPostList()
	{
		if(auth()->check() && auth()->user()->type == 0)
		{
			$posts = Post::orderBy('id', 'desc')->simplePaginate(10);
		}
		else
		{
			$posts = Post::where('created_user_id' , auth()->user()->id)->simplePaginate(10)->withQueryString();
		}
		return $posts;
	}

	/**
	 * guest post
	 */
	public function guestPost()
	{
		$posts = Post::where('status', '=' , 1)->simplePaginate(10)->withQueryString();
		return $posts;
	}

	/**
	 * delete post
	 */
	public function deletePost($id)
	{
		$data = Post::find($id);
		$data['deleted_user_id'] = auth()->user()->id;
		$data->save();
		$data->delete();
	}

	public function search($searchData)
	{
		$searchResult = Post::where('title', 'like', "%" . $searchData . "%")
		                      ->orWhere('description', 'like', "%" . $searchData . "%")
		                      ->orWhereHas('user', function ($user) use ($searchData) {
			                        $user->where('name', 'like', "%" . $searchData . "%");
                              })->simplePaginate(10)->withQueryString();

		return $searchResult;
	}

	/**
	 * find post for update
	 * @param $id
	 */
	public function findPostById($id)
	{
		return Post::find($id);
	}

	/**
	 * update post
	 * @param $data,$id
	 */
	public function updatePost($data , $id)
	{
		if (!isset($data['updated_user_id'])) 
		{
			if (isset($data['status'])) 
			{
			  $data['status'] = 1;
			} 
			else 
			{
			  $data['status'] = 0;
			}
			$data['updated_user_id'] = auth()->user()->id;

			$post = Post::find($id);
			$post->title  = $data->title;
			$post->description  = $data->description;
			$post->updated_user_id  = auth()->user()->id;

			$post->save();
			request()->session()->forget('posts');
		} 
		else 
		{
			Post::find($id)->update($data);
		}
	}

	/**
	 * show detail
	 */
	// public function showDetail($id)
	// {
	// 	return Post::find($id);	
	// }

	public function getDetail($id)
	{
		return Post::where('id',$id)->first();
	}
}