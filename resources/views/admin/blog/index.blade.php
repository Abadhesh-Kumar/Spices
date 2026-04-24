@extends('admin.layout')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
    <div>
        <h1 class="admin-heading">Blog Posts</h1>
        <p class="admin-subheading">Manage recipe and story content with publish status tracking.</p>
    </div>
    <a href="{{ route('admin.blog.create') }}" class="btn-primary">Add Post</a>
</div>

<div class="admin-panel mt-6">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th class="admin-th">Title</th>
                    <th class="admin-th">Slug</th>
                    <th class="admin-th">Published</th>
                    <th class="admin-th">Status</th>
                    <th class="admin-th">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="admin-row">
                        <td class="admin-td">
                            <p class="font-semibold text-slate-900">{{ $post->title }}</p>
                            <p class="mt-1 max-w-xs truncate text-xs text-slate-500">{{ $post->excerpt }}</p>
                        </td>
                        <td class="admin-td">{{ $post->slug }}</td>
                        <td class="admin-td">{{ $post->published_at?->format('d M Y') ?? 'Not published' }}</td>
                        <td class="admin-td">
                            <span class="{{ $post->is_active ? 'badge-success' : 'badge-neutral' }}">
                                {{ $post->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="admin-td">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.blog.edit', $post) }}" class="text-sm font-semibold text-brand-700 hover:text-brand-600">Edit</a>
                                <form action="{{ route('admin.blog.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-semibold text-red-600 hover:text-red-500" onclick="return confirm('Delete this post?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-sm text-slate-500">No blog posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $posts->links() }}</div>
@endsection
