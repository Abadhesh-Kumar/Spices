<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $settings = $siteSettings ?? null;
        $siteName = $settings?->site_name ?: 'Organic Kisan';
        $tagline = $settings?->site_tagline ?: 'Traditional Pantry';
        $metaTitle = $title ?? ($settings?->meta_title ?: ($siteName . ' | Pure Traditional Products'));
        $metaDescription = $description ?? ($settings?->meta_description ?: 'Traditional spices, oils, pickles and home products delivered fresh.');
        $metaKeywords = $settings?->meta_keywords ?: 'spices, masala, cold pressed oil, pickle, organic';
        $supportPhone = $settings?->support_phone ?: '+91 90000 00000';
        $supportEmail = $settings?->support_email ?: 'hello@tradifoods.test';
        $whatsappNumber = preg_replace('/\D+/', '', $settings?->whatsapp_number ?: '919000000000');
        $footerText = $settings?->footer_text ?: 'Traditional taste, natural ingredients, and honest products for every home.';
        $cartCount = collect(session('cart', []))->sum('quantity');
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <link rel="icon" href="/images/favicon.svg">
    @if($settings?->google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', @json($settings->google_analytics_id));
        </script>
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        :root {
            --store-brown-900: #2c1a12;
            --store-brown-700: #5d3822;
            --store-gold-400: #d8ab5f;
            --store-cream-100: #f8f1e4;
            --store-cream-200: #f1e6d5;
            --store-ink: #22160f;
        }

        .store-shell {
            background: var(--store-cream-100);
            color: var(--store-ink);
        }

        .store-top-strip {
            background: linear-gradient(90deg, #1f140f 0%, #2c1a12 40%, #3a2418 100%);
            color: #f5e4cb;
        }

        .store-logo-badge {
            background: radial-gradient(circle at 30% 20%, #f1d29a, #b9843a 65%, #7a4d27 100%);
        }

        .store-menu-link {
            position: relative;
            transition: color 0.2s ease;
        }

        .store-menu-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -0.35rem;
            width: 100%;
            height: 2px;
            transform: scaleX(0);
            transform-origin: center;
            background: var(--store-brown-700);
            transition: transform 0.2s ease;
        }

        .store-menu-link:hover::after {
            transform: scaleX(1);
        }

        .store-pill {
            border: 1px solid #e5d2ba;
            background: #fffaf3;
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .store-pill:hover {
            border-color: #d6b386;
            background: #fff2e0;
        }
    </style>
</head>
<body class="store-shell min-h-screen">
    <header class="sticky top-0 z-40 border-b border-[#e7d7bd] bg-[#fff9f2]/95 backdrop-blur">
        <div class="store-top-strip">
            <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-2 text-[11px] sm:text-xs">
                <p class="font-semibold uppercase tracking-[0.15em] text-[#f7e7cb]">Pure Traditional Products</p>
                <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                    <a href="tel:{{ preg_replace('/\s+/', '', $supportPhone) }}" class="store-pill rounded-full px-3 py-1 font-medium text-[#2c1a12]">{{ $supportPhone }}</a>
                    <a href="{{ route('franchise') }}" class="store-pill rounded-full px-3 py-1 font-medium text-[#2c1a12]">Apply Franchise</a>
                    <a href="{{ route('contact') }}" class="store-pill rounded-full px-3 py-1 font-medium text-[#2c1a12]">Near By Store</a>
                </div>
            </div>
        </div>

        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="store-logo-badge flex h-11 w-11 items-center justify-center rounded-2xl text-base font-extrabold text-white shadow-lg">OK</div>
                <div>
                    <p class="text-xl font-display leading-none">{{ $siteName }}</p>
                    <p class="mt-1 text-[10px] font-semibold uppercase tracking-[0.22em] text-[#7f5738]">{{ $tagline }}</p>
                </div>
            </a>

            <nav class="hidden items-center gap-6 text-sm font-semibold uppercase tracking-wide lg:flex">
                <a href="{{ route('home') }}" class="store-menu-link hover:text-[#5d3822]">Home</a>
                <a href="{{ route('shop.index') }}" class="store-menu-link hover:text-[#5d3822]">Product</a>
                <a href="{{ route('recipes.index') }}" class="store-menu-link hover:text-[#5d3822]">Recipes</a>
                <a href="{{ route('blog.index') }}" class="store-menu-link hover:text-[#5d3822]">Post</a>
                <a href="{{ route('about') }}" class="store-menu-link hover:text-[#5d3822]">About Us</a>
                <a href="{{ route('contact') }}" class="store-menu-link hover:text-[#5d3822]">Contact</a>
            </nav>

            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center rounded-full border border-[#ddc8ab] bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wide text-[#2c1a12] hover:border-[#c29a6d]">
                    Cart
                    @if($cartCount)
                        <span class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-[#8a2d16] text-[10px] font-bold text-white">{{ $cartCount }}</span>
                    @endif
                </a>
                @auth
                    <a href="{{ route('account.orders') }}" class="hidden rounded-full border border-[#ddc8ab] bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wide text-[#2c1a12] hover:border-[#c29a6d] sm:inline-flex">Account</a>
                @else
                    <a href="{{ route('login') }}" class="hidden rounded-full border border-[#ddc8ab] bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wide text-[#2c1a12] hover:border-[#c29a6d] sm:inline-flex">Login</a>
                @endauth
                <button class="rounded-lg border border-[#ddc8ab] bg-white px-3 py-2 lg:hidden" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                    <span class="sr-only">Menu</span>
                    <div class="mb-1 h-0.5 w-5 bg-[#2c1a12]"></div>
                    <div class="mb-1 h-0.5 w-5 bg-[#2c1a12]"></div>
                    <div class="h-0.5 w-5 bg-[#2c1a12]"></div>
                </button>
            </div>
        </div>

        <div id="mobileMenu" class="hidden border-t border-[#e7d7bd] bg-[#fffaf4] lg:hidden">
            <div class="grid gap-2 px-6 py-4 text-sm font-semibold uppercase tracking-wide">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('shop.index') }}">Product</a>
                <a href="{{ route('recipes.index') }}">Recipes</a>
                <a href="{{ route('blog.index') }}">Post</a>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('become-seller') }}">Become Seller</a>
                <a href="{{ route('franchise') }}">Franchise</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
    </header>

    <main>
        @if(session('success'))
            <div class="mx-auto max-w-7xl px-6 pt-6">
                <div class="rounded-2xl border border-[#d9c29f] bg-[#fff2dc] px-4 py-3 text-sm text-[#5d3822]">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <footer class="mt-16 bg-[#23140d] text-[#f6e8d2]">
        <div class="mx-auto grid max-w-7xl gap-8 px-6 py-14 md:grid-cols-4">
            <div>
                <h3 class="text-2xl font-display leading-tight">{{ $siteName }}</h3>
                <p class="mt-4 text-sm text-[#dac9ae]">{{ $footerText }}</p>
                <div class="mt-5 flex flex-wrap gap-2">
                    <a href="{{ route('become-seller') }}" class="rounded-full border border-[#8b5d37] px-3 py-1 text-xs font-semibold uppercase tracking-wide text-[#f4e3c6]">Become Seller</a>
                    <a href="{{ route('franchise') }}" class="rounded-full border border-[#8b5d37] px-3 py-1 text-xs font-semibold uppercase tracking-wide text-[#f4e3c6]">Franchise</a>
                </div>
            </div>

            <div>
                <h4 class="text-xs font-semibold uppercase tracking-[0.22em] text-[#e5cfae]">Quick Links</h4>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                    <li><a href="{{ route('shop.index') }}" class="hover:text-white">Product</a></li>
                    <li><a href="{{ route('recipes.index') }}" class="hover:text-white">Recipes</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-white">Post</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-xs font-semibold uppercase tracking-[0.22em] text-[#e5cfae]">Support</h4>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                    <li><a href="{{ route('account.track') }}" class="hover:text-white">Track Order</a></li>
                    <li><a href="{{ route('shop.index') }}" class="hover:text-white">All Categories</a></li>
                </ul>
                <p class="mt-5 text-sm text-[#dac9ae]">{{ $supportEmail }}</p>
            </div>

            <div>
                <h4 class="text-xs font-semibold uppercase tracking-[0.22em] text-[#e5cfae]">Download App</h4>
                <div class="mt-4 grid gap-2 text-xs">
                    <span class="rounded-xl border border-[#8b5d37] bg-[#2d1a12] px-3 py-2">Google Play (Coming Soon)</span>
                    <span class="rounded-xl border border-[#8b5d37] bg-[#2d1a12] px-3 py-2">App Store (Coming Soon)</span>
                </div>
                <p class="mt-5 text-sm text-[#dac9ae]">Call/WhatsApp: {{ $supportPhone }}</p>
                @if($settings?->contact_address)
                    <p class="mt-2 text-sm text-[#dac9ae]">{{ $settings->contact_address }}</p>
                @endif
            </div>
        </div>
        <div class="border-t border-[#3a261b] py-5 text-center text-xs text-[#cab59a]">
            &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.
        </div>
    </footer>

    @if($whatsappNumber)
        <a href="https://wa.me/{{ $whatsappNumber }}" class="fixed bottom-5 right-5 z-40 rounded-full bg-green-600 px-4 py-3 text-sm font-semibold text-white shadow-soft">WhatsApp</a>
    @endif

    @stack('scripts')
</body>
</html>
