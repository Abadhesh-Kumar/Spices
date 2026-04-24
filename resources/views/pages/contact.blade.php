@extends('layouts.store')

@section('content')
@php
    $settings = $siteSettings ?? null;
    $supportEmail = $settings?->support_email ?: 'hello@tradifoods.test';
    $supportPhone = $settings?->support_phone ?: '+91 90000 00000';
@endphp

<section class="mx-auto max-w-5xl px-6 py-12">
    <h1 class="text-3xl font-display">Contact</h1>
    <p class="mt-4 text-ink/70">Email us at {{ $supportEmail }} or call/WhatsApp {{ $supportPhone }}.</p>

    @if($settings?->contact_address)
        <p class="mt-2 text-sm text-ink/60">Address: {{ $settings->contact_address }}</p>
    @endif

    <form action="{{ route('contact-leads.store') }}" method="POST" class="mt-10 grid max-w-2xl gap-6">
        @csrf
        <div>
            <label class="block text-sm font-medium">Name</label>
            <input name="name" type="text" value="{{ old('name') }}" required class="mt-2 w-full rounded border border-slate-300 px-3 py-2">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Phone</label>
            <input name="phone" type="text" value="{{ old('phone') }}" class="mt-2 w-full rounded border border-slate-300 px-3 py-2">
            @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" required class="mt-2 w-full rounded border border-slate-300 px-3 py-2">
            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Company</label>
            <input name="company" type="text" value="{{ old('company') }}" class="mt-2 w-full rounded border border-slate-300 px-3 py-2">
            @error('company') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Product/service</label>
            <input name="product_service" type="text" value="{{ old('product_service') }}" class="mt-2 w-full rounded border border-slate-300 px-3 py-2">
            @error('product_service') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Message</label>
            <textarea name="message" rows="5" class="mt-2 w-full rounded border border-slate-300 px-3 py-2">{{ old('message') }}</textarea>
            @error('message') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        @if($settings?->captcha_enabled && $settings?->captcha_site_key)
            <div>
                <div class="g-recaptcha" data-sitekey="{{ $settings->captcha_site_key }}"></div>
                @error('captcha') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        @endif

        <div>
            <button type="submit" class="rounded bg-slate-900 px-5 py-2 text-white">Send</button>
        </div>
    </form>
</section>
@endsection

@if(($siteSettings ?? null)?->captcha_enabled && ($siteSettings ?? null)?->captcha_site_key)
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endpush
@endif
