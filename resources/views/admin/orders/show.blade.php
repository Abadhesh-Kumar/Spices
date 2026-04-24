@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-display">Order {{ $order->order_number }}</h1>
<div class="mt-6 grid gap-6 lg:grid-cols-3">
    <div class="card p-6 lg:col-span-2">
        <h2 class="text-lg font-display">Items</h2>
        <div class="mt-4 space-y-3">
            @foreach($order->items as $item)
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold">{{ $item->name }}</p>
                        <p class="text-xs text-ink/60">Qty: {{ $item->quantity }}</p>
                    </div>
                    <div class="text-sm">INR {{ number_format($item->total, 2) }}</div>
                </div>
            @endforeach
        </div>
    </div>
    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="card p-6 space-y-4">
        @csrf
        @method('PATCH')
        <div>
            <label class="text-xs uppercase tracking-widest text-ink/60">Status</label>
            <input name="status" value="{{ $order->status }}" class="mt-2 w-full rounded-full border border-ink/10 px-4 py-2">
        </div>
        <div>
            <label class="text-xs uppercase tracking-widest text-ink/60">Payment Status</label>
            <input name="payment_status" value="{{ $order->payment_status }}" class="mt-2 w-full rounded-full border border-ink/10 px-4 py-2">
        </div>
        <div>
            <label class="text-xs uppercase tracking-widest text-ink/60">Tracking Number</label>
            <input name="tracking_number" value="{{ $order->tracking_number }}" class="mt-2 w-full rounded-full border border-ink/10 px-4 py-2">
        </div>
        <button class="btn-primary">Update</button>
    </form>
</div>
@endsection
