@extends('layouts.store')

@section('content')
<section class="mx-auto max-w-6xl px-6 py-12">
    <h1 class="text-3xl font-display">Checkout</h1>

    <div class="mt-8 grid gap-10 lg:grid-cols-3">
        <form action="{{ route('checkout.place') }}" method="POST" class="lg:col-span-2 card p-8">
            @csrf
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-xs uppercase tracking-widest text-ink/60">Name</label>
                    <input name="name" class="mt-2 w-full rounded-full border border-ink/10 px-4 py-2" required>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-widest text-ink/60">Phone</label>
                    <input name="phone" class="mt-2 w-full rounded-full border border-ink/10 px-4 py-2" required>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-widest text-ink/60">Email</label>
                    <input type="email" name="email" class="mt-2 w-full rounded-full border border-ink/10 px-4 py-2" required>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-widest text-ink/60">Pincode</label>
                    <input name="pincode" class="mt-2 w-full rounded-full border border-ink/10 px-4 py-2" required>
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs uppercase tracking-widest text-ink/60">Address</label>
                    <input name="address" class="mt-2 w-full rounded-full border border-ink/10 px-4 py-2" required>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-widest text-ink/60">City</label>
                    <input name="city" class="mt-2 w-full rounded-full border border-ink/10 px-4 py-2" required>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-widest text-ink/60">State</label>
                    <input name="state" class="mt-2 w-full rounded-full border border-ink/10 px-4 py-2" required>
                </div>
            </div>

            <div class="mt-6">
                <label class="text-xs uppercase tracking-widest text-ink/60">Payment Method</label>
                <div class="mt-3 flex flex-col gap-2">
                    <label class="flex items-center gap-2 text-sm"><input type="radio" name="payment_method" value="razorpay" checked> Razorpay</label>
                    <label class="flex items-center gap-2 text-sm"><input type="radio" name="payment_method" value="cod"> Cash on Delivery</label>
                </div>
            </div>

            <button class="btn-primary mt-8 w-full">Place order</button>
        </form>

        <div class="card p-6">
            <h3 class="text-xl font-display">Order Summary</h3>
            <div class="mt-4 space-y-2 text-sm">
                <div class="flex justify-between"><span>Subtotal</span><span>{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($totals['subtotal'], 2) }}</span></div>
                <div class="flex justify-between"><span>Discount</span><span>-{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($totals['discount'], 2) }}</span></div>
                <div class="flex justify-between"><span>Shipping</span><span>{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($totals['shipping'], 2) }}</span></div>
                <div class="flex justify-between font-semibold"><span>Total</span><span>{{ $siteSettings?->currency_symbol ?? 'INR' }} {{ number_format($totals['total'], 2) }}</span></div>
            </div>
            <div class="mt-6 text-xs text-ink/60">
                Orders paid via Razorpay will be marked as pending until confirmation. COD orders will be confirmed by our team.
            </div>
        </div>
    </div>
</section>
@endsection
