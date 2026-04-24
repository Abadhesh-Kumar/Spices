@php($title = $product->name . ' | TradiFoods')
@php($description = \Illuminate\Support\Str::limit($product->description ?? '', 150))
@extends('layouts.store')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-12">
    <div class="grid gap-10 lg:grid-cols-2">
        <div class="space-y-4">
            <img src="/{{ optional($product->images->first())->path ?? 'images/products/placeholder-1.svg' }}" alt="{{ $product->name }}" class="w-full rounded-3xl object-cover" loading="lazy">
            <div class="grid grid-cols-3 gap-4">
                @foreach($product->images as $image)
                    <img src="/{{ $image->path }}" alt="{{ $image->alt }}" class="h-24 w-full rounded-2xl object-cover" loading="lazy">
                @endforeach
            </div>
        </div>
        <div>
            <p class="text-xs uppercase tracking-widest text-brand-700">{{ $product->category?->name }}</p>
            <h1 class="mt-3 text-3xl font-display">{{ $product->name }}</h1>
            <div class="mt-3 flex items-center gap-3">
                <p class="text-2xl font-semibold">{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($product->discount_price ?? $product->price, 2) }}</p>
                @if($product->discount_price)
                    <p class="text-sm text-ink/50 line-through">{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($product->price, 2) }}</p>
                @endif
                <span class="chip">{{ $product->stock > 0 ? 'In stock' : 'Out of stock' }}</span>
            </div>
            <p class="mt-4 text-ink/70">{{ $product->description }}</p>

            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-6 flex flex-wrap gap-4">
                @csrf
                <div>
                    <label class="text-xs uppercase tracking-widest text-ink/60">Quantity</label>
                    <input type="number" name="quantity" min="1" value="1" class="mt-2 w-24 rounded-full border border-ink/10 px-4 py-2">
                </div>
                <button class="btn-primary">Add to cart</button>
            </form>

            <div class="mt-8">
                <h3 class="text-lg font-display">Ingredients</h3>
                <p class="mt-2 text-sm text-ink/70">{{ $product->ingredients ?? 'Hand-selected regional ingredients with no additives.' }}</p>
            </div>
        </div>
    </div>

    <div class="mt-12">
        <h2 class="text-2xl font-display">Reviews</h2>
        <div class="mt-6 grid gap-4 md:grid-cols-2">
            @forelse($product->reviews as $review)
                <div class="card p-4">
                    <p class="text-sm font-semibold">{{ $review->title ?? 'Verified Buyer' }}</p>
                    <p class="text-xs text-ink/60">Rating: {{ $review->rating }}/5</p>
                    <p class="mt-2 text-sm text-ink/70">{{ $review->body }}</p>
                </div>
            @empty
                <p class="text-ink/60">No reviews yet.</p>
            @endforelse
        </div>
    </div>

    <div class="mt-12">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-display">Related Products</h2>
            <a href="{{ route('shop.index') }}" class="text-sm uppercase tracking-widest text-brand-700">View all</a>
        </div>
        <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($relatedProducts as $related)
                @include('shop.partials.product-card', ['product' => $related])
            @endforeach
        </div>
    </div>
</section>
@endsection
