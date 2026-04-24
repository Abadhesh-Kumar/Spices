@php($title = 'Shop | TradiFoods')
@php($description = 'Browse traditional spices, oils, and pantry staples.') 
@extends('layouts.store')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-10">
    <div class="rounded-3xl border border-[#e5d2b5] bg-gradient-to-r from-[#fff4e0] to-[#ffeed4] p-7">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#8f5a36]">Home / Product</p>
        <h1 class="mt-2 text-3xl font-display text-[#2c1a12]">Shop All Products</h1>
        <p class="mt-2 max-w-2xl text-sm text-[#5e4330]">Browse your full catalog with search, category filters, and price sorting.</p>
    </div>

    <form class="mt-6 grid gap-3 rounded-3xl border border-[#e6d5bb] bg-[#fff9f1] p-4 md:grid-cols-2 xl:grid-cols-5" method="GET">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search products" class="rounded-full border border-[#d6c3a5] bg-white px-4 py-2.5 text-sm">
        <select name="category" class="rounded-full border border-[#d6c3a5] bg-white px-4 py-2.5 text-sm">
            <option value="">All categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->slug }}" @selected($activeCategory == $category->slug)>{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="sort" class="rounded-full border border-[#d6c3a5] bg-white px-4 py-2.5 text-sm">
            <option value="latest" @selected($sort === 'latest')>Newest</option>
            <option value="price_low" @selected($sort === 'price_low')>Price: Low to High</option>
            <option value="price_high" @selected($sort === 'price_high')>Price: High to Low</option>
        </select>
        <a href="{{ route('shop.index') }}" class="inline-flex items-center justify-center rounded-full border border-[#d6c3a5] bg-white px-5 py-2.5 text-sm font-semibold uppercase tracking-wide text-[#5e4330]">Clear</a>
        <button class="inline-flex items-center justify-center rounded-full bg-[#2c1a12] px-5 py-2.5 text-sm font-semibold uppercase tracking-wide text-white">Apply Filters</button>
    </form>

    <div class="mt-5 flex gap-2 overflow-x-auto pb-2">
        <a href="{{ route('shop.index') }}" class="rounded-full border border-[#d9c4a7] bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wide text-[#5d3e28]">All</a>
        @foreach($categories as $category)
            <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="rounded-full border border-[#d9c4a7] bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wide text-[#5d3e28]">{{ $category->name }}</a>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($products as $product)
            @include('shop.partials.product-card', ['product' => $product])
        @empty
            <div class="rounded-3xl border border-[#e6d5bb] bg-[#fff9f1] p-8 text-center text-sm text-[#5e4330]">
                No products found for your current filters.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</section>
@endsection
