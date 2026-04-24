@extends('layouts.store')

@section('content')
<section class="mx-auto max-w-6xl px-6 py-12">
    <h1 class="text-3xl font-display">Your Cart</h1>

    @if(empty($cart))
        <p class="mt-4 text-ink/60">Your cart is empty. <a href="{{ route('shop.index') }}" class="text-brand-700">Shop now</a>.</p>
    @else
        <div class="mt-8 grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart as $item)
                    <div class="card flex flex-col gap-4 p-6 md:flex-row md:items-center">
                        <img src="/{{ $item['image'] ?? 'images/products/placeholder-1.svg' }}" alt="{{ $item['name'] }}" class="h-28 w-28 rounded-2xl object-cover" loading="lazy">
                        <div class="flex-1">
                            <h3 class="text-lg font-display">{{ $item['name'] }}</h3>
                            <p class="text-sm text-ink/60">{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($item['price'], 2) }}</p>
                        </div>
                        <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center gap-3">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" min="1" value="{{ $item['quantity'] }}" class="w-20 rounded-full border border-ink/10 px-3 py-2">
                            <button class="btn-outline">Update</button>
                        </form>
                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm uppercase tracking-widest text-red-600">Remove</button>
                        </form>
                    </div>
                @endforeach
            </div>

            @php
                $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
                $discount = 0;
                if ($coupon && (!$coupon['min_amount'] || $subtotal >= $coupon['min_amount'])) {
                    $discount = $coupon['type'] === 'percent' ? $subtotal * ($coupon['value'] / 100) : $coupon['value'];
                }
                $shipping = $subtotal >= 799 ? 0 : 59;
                $total = max(0, $subtotal - $discount + $shipping);
            @endphp

            <div class="card p-6">
                <h3 class="text-xl font-display">Order Summary</h3>
                <div class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between"><span>Subtotal</span><span>{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($subtotal, 2) }}</span></div>
                    <div class="flex justify-between"><span>Discount</span><span>-{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($discount, 2) }}</span></div>
                    <div class="flex justify-between"><span>Shipping</span><span>{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($shipping, 2) }}</span></div>
                    <div class="flex justify-between font-semibold"><span>Total</span><span>{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($total, 2) }}</span></div>
                </div>

                <form action="{{ route('cart.coupon') }}" method="POST" class="mt-6 flex gap-2">
                    @csrf
                    <input type="text" name="code" placeholder="Coupon code" class="w-full rounded-full border border-ink/10 px-4 py-2">
                    <button class="btn-outline">Apply</button>
                </form>
                @if($coupon)
                    <form action="{{ route('cart.coupon.clear') }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="text-xs uppercase tracking-widest text-ink/60">Remove coupon</button>
                    </form>
                @endif

                <a href="{{ route('checkout.index') }}" class="btn-primary mt-6 w-full">Proceed to checkout</a>
            </div>
        </div>
    @endif
</section>
@endsection
