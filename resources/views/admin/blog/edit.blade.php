@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-display">Edit Blog Post</h1>
<form action="{{ route('admin.blog.update', $post) }}" method="POST" enctype="multipart/form-data" class="mt-6 card p-6 space-y-4">
    @csrf
    @method('PUT')
    <input name="title" value="{{ $post->title }}" class="w-full rounded-full border border-ink/10 px-4 py-2" required>
    <textarea name="excerpt" class="w-full rounded-2xl border border-ink/10 px-4 py-3">{{ $post->excerpt }}</textarea>
    <textarea name="body" class="w-full rounded-2xl border border-ink/10 px-4 py-3" rows="6" required>{{ $post->body }}</textarea>
    <input type="file" name="cover_image" class="w-full">
    <label class="text-sm"><input type="checkbox" name="is_active" value="1" @checked($post->is_active)> Active</label>
    <button class="btn-primary">Update</button>
</form>
@endsection
