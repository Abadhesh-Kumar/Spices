@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-display">Add Blog Post</h1>
<form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 card p-6 space-y-4">
    @csrf
    <input name="title" placeholder="Title" class="w-full rounded-full border border-ink/10 px-4 py-2" required>
    <textarea name="excerpt" placeholder="Excerpt" class="w-full rounded-2xl border border-ink/10 px-4 py-3"></textarea>
    <textarea name="body" placeholder="Body" class="w-full rounded-2xl border border-ink/10 px-4 py-3" rows="6" required></textarea>
    <input type="file" name="cover_image" class="w-full">
    <label class="text-sm"><input type="checkbox" name="is_active" value="1" checked> Active</label>
    <button class="btn-primary">Save</button>
</form>
@endsection
