@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-display">Edit Product</h1>
<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="mt-6 card p-6 space-y-4">
    @csrf
    @method('PUT')
    <input name="name" value="{{ $product->name }}" class="w-full rounded-full border border-ink/10 px-4 py-2" required>
    <select name="category_id" class="w-full rounded-full border border-ink/10 px-4 py-2" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    <div class="grid gap-4 md:grid-cols-3">
        <input name="price" value="{{ $product->price }}" class="rounded-full border border-ink/10 px-4 py-2" required>
        <input name="discount_price" value="{{ $product->discount_price }}" class="rounded-full border border-ink/10 px-4 py-2">
        <input name="stock" value="{{ $product->stock }}" class="rounded-full border border-ink/10 px-4 py-2" required>
    </div>
    <textarea name="description" class="w-full rounded-2xl border border-ink/10 px-4 py-3">{{ $product->description }}</textarea>
    <textarea name="ingredients" class="w-full rounded-2xl border border-ink/10 px-4 py-3">{{ $product->ingredients }}</textarea>
    <input type="file" name="image" class="w-full">
    <div class="flex gap-4 text-sm">
        <label><input type="checkbox" name="is_featured" value="1" @checked($product->is_featured)> Featured</label>
        <label><input type="checkbox" name="is_best_seller" value="1" @checked($product->is_best_seller)> Best Seller</label>
        <label><input type="checkbox" name="is_active" value="1" @checked($product->is_active)> Active</label>
    </div>
    <button class="btn-primary">Update</button>
</form>
@endsection
