@extends('layouts.store')

@section('content')
<section class="mx-auto max-w-5xl px-6 py-12">
    <h1 class="text-3xl font-display">My Orders</h1>
    <div class="mt-6 space-y-4">
        @forelse($orders as $order)
            <div class="card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-brand-700">Order {{ $order->order_number }}</p>
                        <p class="text-sm text-ink/60">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="text-sm font-semibold">{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($order->total, 2) }}</div>
                </div>
                <p class="mt-2 text-sm text-ink/60">Status: {{ $order->status }}</p>
            </div>
        @empty
            <p class="text-ink/60">No orders yet.</p>
        @endforelse
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
</section>
@endsection
