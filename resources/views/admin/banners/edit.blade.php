@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-display">Edit Banner</h1>
<form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="mt-6 card p-6 space-y-4">
    @csrf
    @method('PUT')
    <input name="title" value="{{ $banner->title }}" class="w-full rounded-full border border-ink/10 px-4 py-2" required>
    <input name="subtitle" value="{{ $banner->subtitle }}" class="w-full rounded-full border border-ink/10 px-4 py-2">
    <input name="cta_text" value="{{ $banner->cta_text }}" class="w-full rounded-full border border-ink/10 px-4 py-2">
    <input name="cta_url" value="{{ $banner->cta_url }}" class="w-full rounded-full border border-ink/10 px-4 py-2">
    <input name="sort_order" value="{{ $banner->sort_order }}" class="w-full rounded-full border border-ink/10 px-4 py-2">
    <input type="file" name="image" class="w-full">
    <label class="text-sm"><input type="checkbox" name="is_active" value="1" @checked($banner->is_active)> Active</label>
    <button class="btn-primary">Update</button>
</form>
@endsection
