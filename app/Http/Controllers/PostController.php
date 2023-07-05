<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\IPostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private IPostRepository $postRepository;

    public function __construct(IPostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = $request->is_published === "true" ?
            $this->postRepository->getPublishedPosts() :
            $this->postRepository->getAllPost();

        return response()->json([
            "message" => 'success',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        return response()->json(
            [
                "message" => 'success',
                'data' => $this->postRepository->createPost($request)
            ],
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return response()->json([
            "message" => 'success',
            'data' => $this->postRepository->getPostById($request->route('id'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request)
    {
        return response()->json([
            "message" => 'success',
            'data' => $this->postRepository->updatePost($request->route('id'), $request)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->postRepository->deletePost($request->route('id'));

        return response()->json([
            "message" => 'success',
        ]);
    }
}