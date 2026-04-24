<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin | TradiFoods' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100">
    @php
        $settings = $siteSettings ?? null;
        $adminNavItems = [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => 'admin.dashboard'],
            ['label' => 'Products', 'route' => 'admin.products.index', 'active' => 'admin.products.*'],
            ['label' => 'Categories', 'route' => 'admin.categories.index', 'active' => 'admin.categories.*'],
            ['label' => 'Orders', 'route' => 'admin.orders.index', 'active' => 'admin.orders.*'],
            ['label' => 'Blog', 'route' => 'admin.blog.index', 'active' => 'admin.blog.*'],
            ['label' => 'Banners', 'route' => 'admin.banners.index', 'active' => 'admin.banners.*'],
            ['label' => 'Settings', 'route' => 'admin.settings.edit', 'active' => 'admin.settings.*'],
        ];
    @endphp

    <div class="min-h-screen lg:grid lg:grid-cols-[17rem_1fr]">
        <aside class="bg-slate-900 px-5 py-7 text-white">
            <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl border border-white/10 bg-white/5 px-4 py-4">
                <p class="text-xs uppercase tracking-[0.22em] text-slate-300">Admin Panel</p>
                <h2 class="mt-1 text-2xl font-display text-white">{{ $settings?->site_name ?? 'TradiFoods' }}</h2>
                <p class="mt-1 text-xs text-slate-400">{{ $settings?->site_tagline ?? 'Grocery Control Center' }}</p>
            </a>
            <nav class="mt-8 space-y-2">
                @foreach($adminNavItems as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        class="block rounded-xl px-4 py-2.5 text-sm font-semibold uppercase tracking-wide transition {{ request()->routeIs($item['active']) ? 'bg-white/15 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}"
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="mt-10 border-t border-white/10 pt-5">
                <a href="{{ route('home') }}" class="block text-sm text-slate-300 hover:text-white">Open Storefront</a>
                <form action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="text-sm text-slate-300 hover:text-white">Logout</button>
                </form>
            </div>
        </aside>

        <main class="flex min-h-screen flex-col">
            <header class="border-b border-slate-200 bg-white px-6 py-4 lg:px-8">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Grocery Management</p>
                        <p class="text-sm text-slate-600">Manage products, categories, orders, and website settings.</p>
                    </div>
                    <p class="text-sm font-semibold text-slate-700">{{ auth()->user()->name }}</p>
                </div>
            </header>

            <section class="flex-1 p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{ $slot ?? '' }}
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>
