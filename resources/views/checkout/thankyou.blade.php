@extends('layouts.store')

@section('content')
<section class="mx-auto max-w-4xl px-6 py-16 text-center">
    <div class="card p-10">
        <h1 class="text-3xl font-display">Thank you for your order!</h1>
        <p class="mt-4 text-ink/70">Your order <span class="font-semibold">{{ $order->order_number }}</span> has been received.</p>
        <p class="mt-2 text-ink/60">We will update you with delivery details soon.</p>
        <a href="{{ route('shop.index') }}" class="btn-primary mt-6">Continue shopping</a>
    </div>
</section>
@endsection
