@php
    $image = optional($product->images->first())->path ?? 'images/products/placeholder-1.svg';
    $currentPrice = $product->discount_price ?? $product->price;
@endphp

<article class="group overflow-hidden rounded-[1.6rem] border border-[#e7d4b8] bg-white shadow-[0_20px_35px_-28px_rgba(80,45,21,0.55)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_24px_40px_-26px_rgba(80,45,21,0.65)]">
    <a href="{{ route('product.show', $product->slug) }}" class="block overflow-hidden bg-[#fff7ea]">
        <img src="/{{ $image }}" alt="{{ $product->name }}" class="h-52 w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
    </a>
    <div class="p-5">
        <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#8f5a36]">{{ $product->category?->name ?: 'Traditional Product' }}</p>
        <h3 class="mt-2 text-lg font-display leading-tight text-[#2c1a12]">{{ \Illuminate\Support\Str::limit($product->name, 56) }}</h3>
        <div class="mt-4 flex items-center justify-between gap-2">
            <div class="flex items-end gap-2">
                <p class="text-xl font-semibold text-[#2c1a12]">{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($currentPrice, 2) }}</p>
                @if($product->discount_price)
                    <p class="text-sm text-[#8f6f52] line-through">{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($product->price, 2) }}</p>
                @endif
            </div>
            <span class="rounded-full bg-[#f8e4c8] px-3 py-1 text-[10px] font-semibold uppercase tracking-wide text-[#7d5333]">Fresh</span>
        </div>
        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-4">
            @csrf
            <button class="inline-flex w-full items-center justify-center rounded-full bg-[#2c1a12] px-4 py-2.5 text-xs font-semibold uppercase tracking-[0.13em] text-white transition hover:bg-[#3c2417]">Add To Cart</button>
        </form>
    </div>
</article>
