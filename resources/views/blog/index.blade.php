@extends('layouts.store')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-12">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-display">Recipes & Stories</h1>
            <p class="mt-2 text-ink/60">Traditional recipes, pantry wisdom, and seasonal menus.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($posts as $post)
            <article class="card overflow-hidden">
                <img src="/{{ $post->cover_image }}" alt="{{ $post->title }}" class="h-44 w-full object-cover" loading="lazy">
                <div class="p-6">
                    <p class="text-xs uppercase tracking-widest text-brand-700">{{ $post->published_at?->format('M d, Y') }}</p>
                    <h3 class="mt-2 text-lg font-display">{{ $post->title }}</h3>
                    <p class="mt-2 text-sm text-ink/70">{{ $post->excerpt }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="mt-4 inline-flex text-sm font-semibold text-brand-700">Read article ?</a>
                </div>
            </article>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</section>
@endsection
