@extends('layouts.store')

@section('content')
<section class="mx-auto max-w-5xl px-6 py-12">
    <h1 class="text-3xl font-display">Track Order</h1>
    <form class="mt-6 flex flex-wrap gap-3" method="GET">
        <input name="order_number" placeholder="Enter order number" class="rounded-full border border-ink/10 px-4 py-2">
        <button class="btn-primary">Track</button>
    </form>

    @if(request('order_number'))
        <div class="mt-6">
            @if($order)
                <div class="card p-6">
                    <p class="text-sm font-semibold">Order {{ $order->order_number }}</p>
                    <p class="text-sm text-ink/60">Status: {{ $order->status }}</p>
                    <p class="text-sm text-ink/60">Payment: {{ $order->payment_status }}</p>
                </div>
            @else
                <p class="text-ink/60">No order found for that number.</p>
            @endif
        </div>
    @endif
</section>
@endsection
