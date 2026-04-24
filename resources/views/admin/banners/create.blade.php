@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-display">Add Banner</h1>
<form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 card p-6 space-y-4">
    @csrf
    <input name="title" placeholder="Title" class="w-full rounded-full border border-ink/10 px-4 py-2" required>
    <input name="subtitle" placeholder="Subtitle" class="w-full rounded-full border border-ink/10 px-4 py-2">
    <input name="cta_text" placeholder="CTA Text" class="w-full rounded-full border border-ink/10 px-4 py-2">
    <input name="cta_url" placeholder="CTA URL" class="w-full rounded-full border border-ink/10 px-4 py-2">
    <input name="sort_order" placeholder="Sort Order" class="w-full rounded-full border border-ink/10 px-4 py-2">
    <input type="file" name="image" class="w-full">
    <label class="text-sm"><input type="checkbox" name="is_active" value="1" checked> Active</label>
    <button class="btn-primary">Save</button>
</form>
@endsection
