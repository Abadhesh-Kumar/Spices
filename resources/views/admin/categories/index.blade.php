@extends('admin.layout')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
    <div>
        <h1 class="admin-heading">Categories</h1>
        <p class="admin-subheading">Review and manage your final grocery categories.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary">Add Category</a>
</div>

<div class="admin-panel mt-6">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th class="admin-th">Category</th>
                    <th class="admin-th">Slug</th>
                    <th class="admin-th">Products</th>
                    <th class="admin-th">Status</th>
                    <th class="admin-th">Created</th>
                    <th class="admin-th">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="admin-row">
                        <td class="admin-td">
                            <p class="font-semibold text-slate-900">{{ $category->name }}</p>
                            <p class="mt-1 max-w-xs truncate text-xs text-slate-500">{{ $category->description }}</p>
                        </td>
                        <td class="admin-td">{{ $category->slug }}</td>
                        <td class="admin-td">{{ $category->products_count }}</td>
                        <td class="admin-td">
                            <span class="{{ $category->is_active ? 'badge-success' : 'badge-neutral' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="admin-td">{{ $category->created_at->format('d M Y') }}</td>
                        <td class="admin-td">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-sm font-semibold text-brand-700 hover:text-brand-600">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-semibold text-red-600 hover:text-red-500" onclick="return confirm('Delete this category?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-sm text-slate-500">No categories available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $categories->links() }}</div>
@endsection
