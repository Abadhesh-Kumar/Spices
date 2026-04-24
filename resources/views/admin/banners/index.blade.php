@extends('admin.layout')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
    <div>
        <h1 class="admin-heading">Banners</h1>
        <p class="admin-subheading">Control homepage slider banners with order and status.</p>
    </div>
    <a href="{{ route('admin.banners.create') }}" class="btn-primary">Add Banner</a>
</div>

<div class="admin-panel mt-6">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th class="admin-th">Title</th>
                    <th class="admin-th">Subtitle</th>
                    <th class="admin-th">CTA</th>
                    <th class="admin-th">Sort Order</th>
                    <th class="admin-th">Status</th>
                    <th class="admin-th">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                    <tr class="admin-row">
                        <td class="admin-td font-semibold text-slate-900">{{ $banner->title }}</td>
                        <td class="admin-td max-w-xs truncate">{{ $banner->subtitle }}</td>
                        <td class="admin-td">{{ $banner->cta_text ?: 'No CTA' }}</td>
                        <td class="admin-td">{{ $banner->sort_order }}</td>
                        <td class="admin-td">
                            <span class="{{ $banner->is_active ? 'badge-success' : 'badge-neutral' }}">
                                {{ $banner->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="admin-td">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="text-sm font-semibold text-brand-700 hover:text-brand-600">Edit</a>
                                <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-semibold text-red-600 hover:text-red-500" onclick="return confirm('Delete this banner?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-sm text-slate-500">No banners found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $banners->links() }}</div>
@endsection
