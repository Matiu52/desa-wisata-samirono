<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        return $this->postService->index($request);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        return $this->postService->store($request);
    }

    public function show(Post $post)
    {
        return $this->postService->show($post);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        return $this->postService->update($request, $post);
    }

    public function destroy(Post $post)
    {
        return $this->postService->destroy($post);
    }

    public function list()
    {
        return $this->postService->list();
    }

    public function search(Request $request)
    {
        return $this->postService->index($request);
    }
}