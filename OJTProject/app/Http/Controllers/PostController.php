<?php

namespace App\Http\Controllers;
use App\Contract\Service\Post\PostServiceInterface;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * $postService
     */
    protected $postService;

    public function __construct(PostServiceInterface $post_service_interface)
    {
        $this->middleware(['auth'])->except('guestPost');
        $this->postService = $post_service_interface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->getPostList();
        return view('post.list', compact('posts'));
    }

    /**
     * guset post 
     */
    public function guestPost()
    {
        $posts = $this->postService->guestPost();
        return view('post.list')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatePost(null);
        $request->session()->put('post',$data);
        return redirect('posts/create/collectDataForm');
    }

    /**
     * Show the post create confirm form
     *
     * @return \Illuminate\Http\Response
     */
    public function collectDataForm()
    {
        return view('post.create-confirmation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCollectData(Request $request)
    {
        $this->postService->storeCollectData($request->all());
        return redirect('/posts')->with('successAlert','Post has created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $postDetail = $this->postService->findPostById($id);
        // return view('post.list')->with('post' , $postDetail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = $this->postService->findPostById($id);
        return view('post.edit')->with('posts' , $posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_data = $this->validatePost($id);
        $update_data['id'] = $id;
        $request->session()->put('posts' , $update_data);
        return redirect('posts/update/updateCollectData');
    }

    public function updateCollectData()
    {
        return view('post.update_confirm');
    }

    /**
     * confirm updated post
     * @param int $id
     */
    public function updatePost(Request $request, $id)
    {
        //$update_post = $this->validatePost($id);
        $this->postService->updatePost($request, $id);
        return redirect('/posts')->with('successAlert', 'Post has updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postService->deletePost($id);
        return redirect('/posts')->with('successAlert','Post has deleted successfully');
    }

    public function search(Request $request)
    {
        $searchData = $request->search_data;
        $posts = $this->postService->search($searchData);
        return view('post.list',compact('posts' , 'searchData'));
    }

    /**
     * validate for unique post
     */
    public function validatePost($id)
    {
        return request()->validate([
            'title' => 'required|min:3|max:255|unique:posts,title,' . $id,
            'description' => 'required| min:5|max:255',
            'status' => 'nullable',
        ]);
    }
}
