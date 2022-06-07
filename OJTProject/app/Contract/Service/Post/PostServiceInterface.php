<?php

namespace App\Contract\Service\Post;

interface PostServiceInterface
{
    //store collect data
    public function storeCollectData($data);

    //get post list
    public function getPostList();

    //delete post
    public function deletePost($id);

    //search data
    public function search($searchData);

    //find data for update
    public function findPostById($id);
    
    //update post
    public function updatePost($id);
}