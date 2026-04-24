@php($title = $post->title . ' | TradiFoods')
@php($description = \Illuminate\Support\Str::limit($post->excerpt ?? '', 150))
@extends('layouts.store')

@section('content')
<section class="mx-auto max-w-4xl px-6 py-12">
    <img src="/{{ $post->cover_image }}" alt="{{ $post->title }}" class="h-64 w-full rounded-3xl object-cover" loading="lazy">
    <div class="mt-8">
        <p class="text-xs uppercase tracking-widest text-brand-700">{{ $post->published_at?->format('M d, Y') }}</p>
        <h1 class="mt-2 text-3xl font-display">{{ $post->title }}</h1>
        <div class="mt-4 text-ink/70 whitespace-pre-line">{{ $post->body }}</div>
    </div>
</section>
@endsection
