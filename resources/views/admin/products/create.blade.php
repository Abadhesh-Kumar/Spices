@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-display">Add Product</h1>
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 card p-6 space-y-4">
    @csrf
    <input name="name" placeholder="Product name" class="w-full rounded-full border border-ink/10 px-4 py-2" required>
    <select name="category_id" class="w-full rounded-full border border-ink/10 px-4 py-2" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <div class="grid gap-4 md:grid-cols-3">
        <input name="price" placeholder="Price" class="rounded-full border border-ink/10 px-4 py-2" required>
        <input name="discount_price" placeholder="Discount price" class="rounded-full border border-ink/10 px-4 py-2">
        <input name="stock" placeholder="Stock" class="rounded-full border border-ink/10 px-4 py-2" required>
    </div>
    <textarea name="description" placeholder="Description" class="w-full rounded-2xl border border-ink/10 px-4 py-3"></textarea>
    <textarea name="ingredients" placeholder="Ingredients" class="w-full rounded-2xl border border-ink/10 px-4 py-3"></textarea>
    <input type="file" name="image" class="w-full">
    <div class="flex gap-4 text-sm">
        <label><input type="checkbox" name="is_featured" value="1"> Featured</label>
        <label><input type="checkbox" name="is_best_seller" value="1"> Best Seller</label>
        <label><input type="checkbox" name="is_active" value="1" checked> Active</label>
    </div>
    <button class="btn-primary">Save</button>
</form>
@endsection
