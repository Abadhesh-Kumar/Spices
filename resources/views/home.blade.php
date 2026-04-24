@extends('layouts.store')

@section('content')
@php
    $catalogGroups = [
        'Masala Blends' => [
            'Garam Masala',
            'Dal Masala',
            'Chana Masala',
            'Raita Masala',
            'Kitchen King Masala',
            'Sabzi Masala',
            'Shahi Paneer Masala',
            'Pav Bhaji Masala',
            'Rajma Masala',
            'Dal Makhani Masala',
        ],
        'Pickle And Chutney Mixes' => [
            'Golgappa Masala',
            'Jaljeera',
            'Aam Achar Masala',
            'Mirch Achar Masala',
            'Sweet Lemon Pickle Mix',
            'Pudina Chutney Powder',
            'Amchur Powder',
            'Salad Masala',
        ],
        'Whole Spices And Powders' => [
            'Kala Namak',
            'Sulemani Namak',
            'Jeera',
            'Laung',
            'Dalchini',
            'Jaiphal',
            'Badi Elaichi',
            'Choti Elaichi',
            'Ajwain',
            'Methi Dana',
            'Kashmiri Mirch',
            'Haldi Powder',
        ],
        'Oils Ghee And Home Care' => [
            'Sarson Oil',
            'Desi Ghee',
            'Cow Ghee',
            'Handwash Liquid',
            'Dishwash Liquid',
            'Toilet Cleaner',
            'Bathroom Cleaner',
            'Phenyl',
            'Detergent Powder',
            'Pitambari',
        ],
    ];

    $homeSpotlightProducts = $featuredProducts->isNotEmpty()
        ? $featuredProducts->take(8)
        : ($newArrivals->isNotEmpty() ? $newArrivals->take(8) : $bestSellers->take(8));
@endphp

<div class="reference-home">
    <section
        class="relative overflow-hidden border-b border-[#e3ceb0] bg-[#2c1a12] text-white"
        x-data="{
            active: 0,
            total: {{ max($banners->count(), 1) }},
            timer: null,
            init() {
                if (this.total > 1) {
                    this.startAutoPlay();
                }
            },
            startAutoPlay() {
                this.stopAutoPlay();
                this.timer = setInterval(() => this.next(), 5000);
            },
            stopAutoPlay() {
                if (this.timer) {
                    clearInterval(this.timer);
                    this.timer = null;
                }
            },
            next() {
                this.active = (this.active + 1) % this.total;
            },
            prev() {
                this.active = (this.active - 1 + this.total) % this.total;
            },
            go(index) {
                this.active = index;
            }
        }"
        @mouseenter="stopAutoPlay()"
        @mouseleave="if (total > 1) startAutoPlay()"
    >
        <div class="home-hero-overlay pointer-events-none absolute inset-0"></div>
        <div class="mx-auto grid max-w-7xl gap-10 px-6 py-12 lg:grid-cols-5 lg:items-center">
            <div class="relative z-10 lg:col-span-2">
                <span class="inline-flex rounded-full border border-white/40 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white/90">Organic Product Collection</span>
                <h1 class="mt-5 text-4xl font-display leading-tight text-white md:text-5xl">Traditional Taste For Modern Homes</h1>
                <p class="mt-4 text-sm leading-relaxed text-white/80">
                    We reviewed your PDF catalog and mapped it into the website experience: masala blends, pickles, oils, ghee, and home essentials in one storefront.
                </p>
                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center justify-center rounded-full bg-[#f4d6a6] px-6 py-3 text-sm font-semibold uppercase tracking-wide text-[#2c1a12] transition hover:bg-[#ffe1b0]">Shop Product</a>
                    <a href="{{ route('franchise') }}" class="inline-flex items-center justify-center rounded-full border border-white/40 px-6 py-3 text-sm font-semibold uppercase tracking-wide text-white transition hover:border-white/70">Apply Franchise</a>
                </div>
                <div class="mt-8 grid grid-cols-2 gap-4 text-sm">
                    <div class="home-stat rounded-2xl p-4">
                        <p class="text-2xl font-semibold text-[#ffd69d]">80+</p>
                        <p class="text-white/75">Products in your PDF list</p>
                    </div>
                    <div class="home-stat rounded-2xl p-4">
                        <p class="text-2xl font-semibold text-[#ffd69d]">4+</p>
                        <p class="text-white/75">Core catalog families</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 lg:col-span-3">
                <div class="relative min-h-[360px] overflow-hidden rounded-3xl border border-white/20 bg-black/30 shadow-soft md:min-h-[430px]">
                    @forelse($banners as $index => $banner)
                        <article
                            class="absolute inset-0"
                            x-cloak
                            x-show="active === {{ $index }}"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4"
                        >
                            @if($banner->image)
                                <img src="/{{ $banner->image }}" alt="{{ $banner->title }}" class="h-full w-full object-cover" loading="lazy">
                            @else
                                <div class="h-full w-full bg-[#3b2318]"></div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/50 to-black/20"></div>
                            <div class="absolute inset-x-0 bottom-0 p-7 md:p-8">
                                <p class="text-xs uppercase tracking-[0.24em] text-[#f7ddb2]">Seasonal Highlight</p>
                                <h2 class="mt-2 max-w-xl text-3xl font-display text-white md:text-4xl">{{ $banner->title }}</h2>
                                @if($banner->subtitle)
                                    <p class="mt-3 max-w-xl text-sm text-white/85">{{ $banner->subtitle }}</p>
                                @endif
                                <a href="{{ $banner->cta_url ?: route('shop.index') }}" class="mt-5 inline-flex rounded-full bg-[#f4d6a6] px-5 py-2 text-xs font-semibold uppercase tracking-widest text-[#2c1a12]">
                                    {{ $banner->cta_text ?: 'Shop Collection' }}
                                </a>
                            </div>
                        </article>
                    @empty
                        <article class="absolute inset-0">
                            <img src="/images/banners/banner-1.svg" alt="Traditional organic products" class="h-full w-full object-cover" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/50 to-black/20"></div>
                            <div class="absolute inset-x-0 bottom-0 p-7 md:p-8">
                                <p class="text-xs uppercase tracking-[0.24em] text-[#f7ddb2]">Organic Kisan FPO</p>
                                <h2 class="mt-2 max-w-xl text-3xl font-display text-white md:text-4xl">From masala blends to cold-pressed oils.</h2>
                                <p class="mt-3 max-w-xl text-sm text-white/85">Your product PDF has been mapped into ready-to-browse storefront sections.</p>
                                <a href="{{ route('shop.index') }}" class="mt-5 inline-flex rounded-full bg-[#f4d6a6] px-5 py-2 text-xs font-semibold uppercase tracking-widest text-[#2c1a12]">Shop Collection</a>
                            </div>
                        </article>
                    @endforelse
                </div>

                @if($banners->count() > 1)
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex gap-2">
                            @foreach($banners as $index => $banner)
                                <button
                                    type="button"
                                    @click="go({{ $index }})"
                                    :class="active === {{ $index }} ? 'bg-[#f4d6a6]' : 'bg-white/40'"
                                    class="h-2.5 w-7 rounded-full transition"
                                    aria-label="Go to slide {{ $index + 1 }}"
                                ></button>
                            @endforeach
                        </div>
                        <div class="flex gap-2">
                            <button type="button" @click="prev()" class="rounded-full border border-white/30 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-white hover:border-white">Prev</button>
                            <button type="button" @click="next()" class="rounded-full border border-white/30 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-white hover:border-white">Next</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="mx-auto -mt-2 max-w-7xl px-6 py-8">
        <div class="grid gap-4 md:grid-cols-3">
            <a href="{{ route('become-seller') }}" class="action-tile block rounded-3xl p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7d5333]">Business</p>
                <h3 class="mt-3 text-2xl font-display text-[#2c1a12]">Become A Seller</h3>
                <p class="mt-2 text-sm text-[#5e4330]">Partner with us and list regional products on the platform.</p>
            </a>
            <a href="{{ route('contact') }}" class="action-tile block rounded-3xl p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7d5333]">Nearby</p>
                <h3 class="mt-3 text-2xl font-display text-[#2c1a12]">Find Store</h3>
                <p class="mt-2 text-sm text-[#5e4330]">Locate nearest support point and connect with our team.</p>
            </a>
            <a href="{{ route('franchise') }}" class="action-tile block rounded-3xl p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7d5333]">Expansion</p>
                <h3 class="mt-3 text-2xl font-display text-[#2c1a12]">Become Franchise</h3>
                <p class="mt-2 text-sm text-[#5e4330]">Launch your own outlet with branding and operational support.</p>
            </a>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-7">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-2xl font-display">Category Navigator</h2>
            <a href="{{ route('shop.index') }}" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7d5333]">View All Product</a>
        </div>
        <div class="mt-5 flex gap-3 overflow-x-auto pb-2">
            <a href="{{ route('shop.index') }}" class="category-chip whitespace-nowrap rounded-full px-5 py-2 text-xs font-semibold uppercase tracking-wider">All</a>
            @foreach($categories as $category)
                <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="category-chip whitespace-nowrap rounded-full px-5 py-2 text-xs font-semibold uppercase tracking-wider">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </section>

    @if($homeSpotlightProducts->isNotEmpty())
        <section class="mx-auto max-w-7xl px-6 py-8">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-2xl font-display">Featured Products</h2>
                <a href="{{ route('shop.index') }}" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7d5333]">Explore More</a>
            </div>
            <div class="mt-7 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($homeSpotlightProducts as $product)
                    @include('shop.partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </section>
    @endif

    <section class="border-y border-[#ead7ba] bg-[#fff8ee]">
        <div class="mx-auto max-w-7xl px-6 py-12">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7d5333]">Product List Mapping</p>
                    <h2 class="mt-2 text-3xl font-display text-[#2c1a12]">Catalog Extracted From Your PDF</h2>
                    <p class="mt-3 max-w-3xl text-sm text-[#5e4330]">
                        We extracted and organized your Organic Product List PDF into practical storefront groups so customers can discover products faster.
                    </p>
                </div>
                <div class="rounded-2xl border border-[#d9c1a0] bg-[#fff1db] px-6 py-4 text-center">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#8f5a36]">PDF Coverage</p>
                    <p class="mt-1 text-2xl font-semibold text-[#2c1a12]">80+ SKU</p>
                </div>
            </div>
            <div class="mt-8 grid gap-5 md:grid-cols-2">
                @foreach($catalogGroups as $group => $items)
                    <article class="catalog-group-card rounded-3xl p-6">
                        <h3 class="text-xl font-display text-[#2c1a12]">{{ $group }}</h3>
                        <ul class="mt-4 grid grid-cols-1 gap-2 text-sm text-[#513624] sm:grid-cols-2">
                            @foreach($items as $item)
                                <li class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#8f5a36]"></span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @if($bestSellers->isNotEmpty() || $newArrivals->isNotEmpty())
        <section class="mx-auto max-w-7xl px-6 py-12">
            <div class="grid gap-8 xl:grid-cols-2">
                @if($bestSellers->isNotEmpty())
                    <div>
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-display">Best Selling</h2>
                            <a href="{{ route('shop.index') }}" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7d5333]">See All</a>
                        </div>
                        <div class="mt-6 grid gap-6 sm:grid-cols-2">
                            @foreach($bestSellers->take(4) as $product)
                                @include('shop.partials.product-card', ['product' => $product])
                            @endforeach
                        </div>
                    </div>
                @endif
                @if($newArrivals->isNotEmpty())
                    <div>
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-display">New Arrivals</h2>
                            <a href="{{ route('shop.index') }}" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7d5333]">See All</a>
                        </div>
                        <div class="mt-6 grid gap-6 sm:grid-cols-2">
                            @foreach($newArrivals->take(4) as $product)
                                @include('shop.partials.product-card', ['product' => $product])
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    @if($blogPosts->isNotEmpty())
        <section class="mx-auto max-w-7xl px-6 pb-12 pt-4">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-2xl font-display">Recipe And Story Posts</h2>
                <a href="{{ route('blog.index') }}" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7d5333]">Read More</a>
            </div>
            <div class="mt-7 grid gap-6 md:grid-cols-3">
                @foreach($blogPosts as $post)
                    <article class="story-card overflow-hidden rounded-3xl">
                        <img src="/{{ $post->cover_image ?: 'images/banners/banner-2.svg' }}" alt="{{ $post->title }}" class="h-44 w-full object-cover" loading="lazy">
                        <div class="p-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#8f5a36]">{{ $post->published_at?->format('M d, Y') }}</p>
                            <h3 class="mt-2 text-xl font-display leading-tight text-[#2c1a12]">{{ $post->title }}</h3>
                            <p class="mt-3 text-sm text-[#5e4330]">{{ \Illuminate\Support\Str::limit($post->excerpt, 120) }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="mt-4 inline-flex text-sm font-semibold text-[#7d5333]">Read Post</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    @if($testimonials->isNotEmpty())
        <section class="bg-[#2c1a12] text-[#f7e7cf]">
            <div class="mx-auto max-w-7xl px-6 py-12">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-2xl font-display text-white">Customer Feedback</h2>
                    <p class="text-sm text-[#e8d0ac]">Trusted by home cooks and regular buyers.</p>
                </div>
                <div class="mt-7 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                    @foreach($testimonials as $testimonial)
                        <article class="rounded-3xl border border-white/15 bg-white/10 p-6">
                            <img src="/{{ $testimonial->avatar }}" alt="{{ $testimonial->name }}" class="h-14 w-14 rounded-full object-cover" loading="lazy">
                            <p class="mt-4 text-sm leading-relaxed text-[#f6e8d3]">"{{ $testimonial->body }}"</p>
                            <p class="mt-4 text-sm font-semibold text-white">{{ $testimonial->name }}</p>
                            <p class="text-xs text-[#efdbbf]">{{ $testimonial->role }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="mx-auto max-w-7xl px-6 py-12">
        <div class="newsletter-panel grid gap-8 rounded-3xl p-8 lg:grid-cols-2 lg:items-center">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#8f5a36]">Stay Updated</p>
                <h2 class="mt-2 text-3xl font-display text-[#2c1a12]">Get Offers, Recipes And New Product Alerts</h2>
                <p class="mt-3 text-sm text-[#5e4330]">
                    Subscribe once and receive updates about masala launches, seasonal pickles, and fresh stock additions from your catalog lineup.
                </p>
            </div>
            <form action="{{ route('newsletter.store') }}" method="POST" class="flex flex-col gap-3 sm:flex-row">
                @csrf
                <input type="email" name="email" placeholder="Enter your email" class="w-full rounded-full border border-[#d6c0a3] bg-white px-5 py-3 text-sm" required>
                <button type="submit" class="inline-flex items-center justify-center rounded-full bg-[#2c1a12] px-7 py-3 text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-[#3b2418]">Subscribe</button>
            </form>
        </div>
    </section>
</div>
@endsection

@push('styles')
    <style>
        .reference-home {
            background: linear-gradient(180deg, #f9f2e4 0%, #f6ecdc 55%, #f9f2e4 100%);
        }

        .home-hero-overlay {
            background:
                radial-gradient(circle at 20% 15%, rgba(244, 214, 166, 0.22), transparent 34%),
                radial-gradient(circle at 78% 10%, rgba(180, 114, 53, 0.35), transparent 30%),
                radial-gradient(circle at 70% 80%, rgba(100, 58, 30, 0.28), transparent 45%);
        }

        .home-stat {
            background: linear-gradient(140deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.08));
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .action-tile {
            background: linear-gradient(140deg, #fff7ea 0%, #ffefd9 100%);
            border: 1px solid #e4cfaf;
            box-shadow: 0 18px 36px -28px rgba(80, 45, 21, 0.45);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .action-tile:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 42px -26px rgba(80, 45, 21, 0.6);
        }

        .category-chip {
            background: #fff9f1;
            border: 1px solid #decaab;
            color: #5c3c26;
            transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }

        .category-chip:hover {
            background: #2c1a12;
            border-color: #2c1a12;
            color: #fff1dc;
        }

        .catalog-group-card {
            background: linear-gradient(155deg, #fffdf8 0%, #fff4e4 100%);
            border: 1px solid #e5d1b3;
            box-shadow: 0 16px 36px -30px rgba(80, 45, 21, 0.6);
        }

        .story-card {
            border: 1px solid #e6d1b1;
            background: #fffdf8;
            box-shadow: 0 16px 34px -26px rgba(80, 45, 21, 0.4);
        }

        .newsletter-panel {
            border: 1px solid #dfc8a8;
            background: linear-gradient(140deg, #fff8ea 0%, #ffeccf 100%);
            box-shadow: 0 22px 40px -30px rgba(80, 45, 21, 0.55);
        }
    </style>
@endpush
