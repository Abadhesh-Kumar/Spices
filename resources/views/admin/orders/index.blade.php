@extends('admin.layout')

@section('content')
<div>
    <h1 class="admin-heading">Orders</h1>
    <p class="admin-subheading">Track order status, payment state, and customer details in one table.</p>
</div>

<div class="admin-panel mt-6">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th class="admin-th">Order</th>
                    <th class="admin-th">Customer</th>
                    <th class="admin-th">Total</th>
                    <th class="admin-th">Status</th>
                    <th class="admin-th">Payment</th>
                    <th class="admin-th">Date</th>
                    <th class="admin-th">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    @php
                        $statusClass = match (strtolower($order->status)) {
                            'delivered' => 'badge-success',
                            'cancelled', 'failed' => 'badge-danger',
                            'pending', 'processing' => 'badge-warning',
                            default => 'badge-neutral',
                        };

                        $paymentClass = match (strtolower($order->payment_status)) {
                            'paid' => 'badge-success',
                            'failed' => 'badge-danger',
                            'unpaid', 'pending' => 'badge-warning',
                            default => 'badge-neutral',
                        };
                    @endphp
                    <tr class="admin-row">
                        <td class="admin-td font-semibold text-slate-900">{{ $order->order_number }}</td>
                        <td class="admin-td">
                            <p>{{ $order->customer_name }}</p>
                            <p class="text-xs text-slate-500">{{ $order->customer_phone }}</p>
                        </td>
                        <td class="admin-td font-semibold text-slate-900">INR {{ number_format($order->total, 2) }}</td>
                        <td class="admin-td"><span class="{{ $statusClass }}">{{ ucfirst($order->status) }}</span></td>
                        <td class="admin-td"><span class="{{ $paymentClass }}">{{ ucfirst($order->payment_status) }}</span></td>
                        <td class="admin-td">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        <td class="admin-td">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-sm font-semibold text-brand-700 hover:text-brand-600">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-sm text-slate-500">No orders available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $orders->links() }}</div>
@endsection
