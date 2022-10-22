<?php

namespace App\Http\Controllers\Post;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class EditController extends Controller
{
    public function __invoke(Post $post)
    {
        $categories = Category::All();
        return view('posts.edit', compact('post', 'categories'));
    }
}
