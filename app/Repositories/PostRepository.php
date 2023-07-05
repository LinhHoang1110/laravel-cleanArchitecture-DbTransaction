<?php

namespace App\Repositories;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\IPostRepository;
use App\Models\Post;

class PostRepository implements IPostRepository
{
    private DbTransactionRepository $transaction;
    private Post $post;
    public function __construct(Post $post, DbTransactionRepository $transaction)
    {
        $this->post = $post;
        $this->transaction = $transaction;
    }

    public function getAllPost()
    {
        return $this->post->all();
    }

    public function getPostById($postId)
    {
        return $this->post->findOrFail($postId);
    }

    public function getPublishedPosts()
    {
        return $this->post->where('is_published', true)->get();
    }

    public function createPost(StorePostRequest $storePostRequest)
    {
        return $this->transaction->dbTransaction(function () use($storePostRequest) {
            $this->post->create($storePostRequest->toArray());
        });
    }

    public function updatePost($postId, UpdatePostRequest $updatePostRequest)
    {
        $post = $this->post->find($postId);
        if ($post) {
            $post->update($updatePostRequest->toArray());
        }
    }


    public function deletePost($postId)
    {
        $this->post->destroy($postId);
    }
}
