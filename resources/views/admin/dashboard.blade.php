@extends('admin.layout')

@section('content')
<div>
    <h1 class="admin-heading">Dashboard</h1>
    <p class="admin-subheading">Quick overview of your grocery business performance.</p>
</div>

<div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
    <div class="admin-panel p-5">
        <p class="text-xs uppercase tracking-widest text-slate-500">Orders</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $totalOrders }}</p>
    </div>
    <div class="admin-panel p-5">
        <p class="text-xs uppercase tracking-widest text-slate-500">Customers</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $totalUsers }}</p>
    </div>
    <div class="admin-panel p-5">
        <p class="text-xs uppercase tracking-widest text-slate-500">Products</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $totalProducts }}</p>
    </div>
    <div class="admin-panel p-5">
        <p class="text-xs uppercase tracking-widest text-slate-500">Categories</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $totalCategories }}</p>
    </div>
    <div class="admin-panel p-5">
        <p class="text-xs uppercase tracking-widest text-slate-500">Sales</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">INR {{ number_format($totalSales, 2) }}</p>
    </div>
</div>

<div class="mt-10">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-display">Recent Orders</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-brand-700">View all orders</a>
    </div>
    <div class="admin-panel mt-4">
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th class="admin-th">Order</th>
                        <th class="admin-th">Customer</th>
                        <th class="admin-th">Status</th>
                        <th class="admin-th">Payment</th>
                        <th class="admin-th">Total</th>
                        <th class="admin-th">Placed</th>
                        <th class="admin-th">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        @php
                            $statusClass = match (strtolower($order->status)) {
                                'delivered' => 'badge-success',
                                'cancelled', 'failed' => 'badge-danger',
                                'pending', 'processing' => 'badge-warning',
                                default => 'badge-neutral',
                            };
                        @endphp
                        <tr class="admin-row">
                            <td class="admin-td font-semibold text-slate-900">{{ $order->order_number }}</td>
                            <td class="admin-td">{{ $order->customer_name }}</td>
                            <td class="admin-td"><span class="{{ $statusClass }}">{{ ucfirst($order->status) }}</span></td>
                            <td class="admin-td">{{ ucfirst($order->payment_status) }}</td>
                            <td class="admin-td font-semibold text-slate-900">INR {{ number_format($order->total, 2) }}</td>
                            <td class="admin-td">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="admin-td">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-sm font-semibold text-brand-700 hover:text-brand-600">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-8 text-center text-sm text-slate-500">No orders found yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
