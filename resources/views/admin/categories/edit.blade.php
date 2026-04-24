@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-display">Edit Category</h1>
<form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="mt-6 card p-6 space-y-4">
    @csrf
    @method('PUT')
    <input name="name" value="{{ $category->name }}" class="w-full rounded-full border border-ink/10 px-4 py-2" required>
    <textarea name="description" class="w-full rounded-2xl border border-ink/10 px-4 py-3">{{ $category->description }}</textarea>
    <input type="file" name="image" class="w-full">
    <label class="text-sm"><input type="checkbox" name="is_active" value="1" @checked($category->is_active)> Active</label>
    <button class="btn-primary">Update</button>
</form>
@endsection
