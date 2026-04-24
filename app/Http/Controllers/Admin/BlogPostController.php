<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        return view('admin.blog.index', [
            'posts' => BlogPost::latest()->paginate(12),
        ]);
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'is_active' => 'sometimes|boolean',
        ]);

        $post = BlogPost::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'excerpt' => $data['excerpt'] ?? null,
            'body' => $data['body'],
            'is_active' => $request->boolean('is_active', true),
            'published_at' => now(),
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('blog', 'public');
            $post->update(['cover_image' => 'storage/' . $path]);
        }

        return redirect()->route('admin.blog.index');
    }

    public function edit(BlogPost $blog)
    {
        return view('admin.blog.edit', [
            'post' => $blog,
        ]);
    }

    public function update(Request $request, BlogPost $blog)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'is_active' => 'sometimes|boolean',
        ]);

        $blog->update([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'excerpt' => $data['excerpt'] ?? null,
            'body' => $data['body'],
            'is_active' => $request->boolean('is_active', true),
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('blog', 'public');
            $blog->update(['cover_image' => 'storage/' . $path]);
        }

        return redirect()->route('admin.blog.index');
    }

    public function destroy(BlogPost $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blog.index');
    }
}
