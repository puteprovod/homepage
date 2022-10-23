<?php

namespace App\Http\Controllers;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //comment22221324
    public function index(FilterRequest $request)
    {
        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;
        $filter=app()->make(PostFilter::class,['queryParams'=>array_filter($data)]);
        $posts=Post::filter($filter)->paginate($perPage,['*'],'page',$page);
        return PostResource::collection($posts);
        //return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::All();
        return view('posts.create', compact('categories'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::All();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(UpdateRequest $request, Post $post)
    {

        $data = $request->validated();
        $post->update($data);
        $post->fresh();
        return new PostResource($post);
        //  return redirect()->route('posts.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $post = Post::create($data);
        return new PostResource($post);
       // return redirect()->route('posts.index');
    }
}
