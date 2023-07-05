<?php

namespace App\Interfaces;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

interface IPostRepository
{
    public function getAllPost();
    public function getPostById($postId);
    public function getPublishedPosts();
    public function createPost(StorePostRequest $storePostRequest);
    public function updatePost($postId, UpdatePostRequest $updatePostRequest);
    public function deletePost($postId);
}