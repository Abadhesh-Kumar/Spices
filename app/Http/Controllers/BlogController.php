<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index', [
            'posts' => BlogPost::where('is_active', true)->latest('published_at')->paginate(9),
        ]);
    }

    public function show(string $slug)
    {
        $post = BlogPost::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('blog.show', ['post' => $post]);
    }
}
