@extends('admin.layout')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
    <div>
        <h1 class="admin-heading">Products</h1>
        <p class="admin-subheading">Show all grocery products in a structured table format.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn-primary">Add Product</a>
</div>

<div class="admin-panel mt-6">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th class="admin-th">Product</th>
                    <th class="admin-th">Category</th>
                    <th class="admin-th">Price</th>
                    <th class="admin-th">Stock</th>
                    <th class="admin-th">Flags</th>
                    <th class="admin-th">Status</th>
                    <th class="admin-th">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="admin-row">
                        <td class="admin-td">
                            <p class="font-semibold text-slate-900">{{ $product->name }}</p>
                            <p class="text-xs text-slate-500">{{ $product->slug }}</p>
                        </td>
                        <td class="admin-td">{{ $product->category?->name ?? 'Uncategorized' }}</td>
                        <td class="admin-td">
                            @if($product->discount_price)
                                <p class="font-semibold text-slate-900">INR {{ number_format($product->discount_price, 2) }}</p>
                                <p class="text-xs text-slate-500 line-through">INR {{ number_format($product->price, 2) }}</p>
                            @else
                                <p class="font-semibold text-slate-900">INR {{ number_format($product->price, 2) }}</p>
                            @endif
                        </td>
                        <td class="admin-td">{{ $product->stock }}</td>
                        <td class="admin-td">
                            <div class="flex flex-wrap gap-2">
                                @if($product->is_featured)
                                    <span class="badge-success">Featured</span>
                                @endif
                                @if($product->is_best_seller)
                                    <span class="badge-warning">Best Seller</span>
                                @endif
                                @if(!$product->is_featured && !$product->is_best_seller)
                                    <span class="badge-neutral">Standard</span>
                                @endif
                            </div>
                        </td>
                        <td class="admin-td">
                            <span class="{{ $product->is_active ? 'badge-success' : 'badge-neutral' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="admin-td">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-sm font-semibold text-brand-700 hover:text-brand-600">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-semibold text-red-600 hover:text-red-500" onclick="return confirm('Delete this product?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-sm text-slate-500">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $products->links() }}</div>
@endsection
