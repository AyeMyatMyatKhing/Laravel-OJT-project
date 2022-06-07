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
      $data['created_user_id'] = 1;
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
		$posts = Post::orderBy('id', 'desc')->simplePaginate(10);
		return $posts;
	}

	/**
	 * delete post
	 */
	public function deletePost($id)
	{
		Post::find($id)->delete();
	}

	public function search($searchData)
	{
		$searchResult = Post::where('title', 'like', "%" . $searchData . "%")
		                      ->orWhere('description', 'like', "%" . $searchData . "%")
													->simplePaginate(10)->withQueryString();
		                      // ->orWhereHas('user', function ($user) use ($searchData) {
			                    //   $user->where('name', 'like', "%" . $searchData . "%");
                          // })->simplePaginate(10)->withQueryString();

		return $searchResult;
	}

	/**
	 * find post for update
	 */
	public function findPostById($id)
	{
		return Post::Find($id);
	}

	/**
	 * update post
	 */
	public function updatePost($id)
	{
		// if (!isset($update_data['updated_user_id'])) 
		// {
		// 	if (isset($update_data['status'])) 
		// 	{
		// 	  $update_data['status'] = 1;
		// 	} 
		// 	else 
		// 	{
		// 	  $update_data['status'] = 0;
		// 	}
		// 	$post_data_to_update['updated_user_id'] = auth()->user()->id;
		// 	Post::find($id)->update($update_data);
		// 	request()->session()->forget('posts');
		// } 
		// else 
		// {
		// 	Post::find($id)->update($update_data);
		// }
		Post::find($id)->update($update_data);
	}
}