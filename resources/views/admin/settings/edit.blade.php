@extends('admin.layout')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
    <div>
        <h1 class="admin-heading">Store Settings</h1>
        <p class="admin-subheading">Manage website identity, contact details, integrations, and security.</p>
    </div>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" class="mt-6 space-y-6">
    @csrf
    @method('PUT')

    <section class="admin-panel p-6">
        <h2 class="text-lg font-semibold text-slate-900">Website</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div>
                <label class="admin-label" for="site_name">Site Name</label>
                <input id="site_name" name="site_name" value="{{ old('site_name', $settings->site_name) }}" class="admin-input">
                @error('site_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="admin-label" for="site_tagline">Tagline</label>
                <input id="site_tagline" name="site_tagline" value="{{ old('site_tagline', $settings->site_tagline) }}" class="admin-input">
                @error('site_tagline') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="admin-label" for="currency_symbol">Currency Label</label>
                <input id="currency_symbol" name="currency_symbol" value="{{ old('currency_symbol', $settings->currency_symbol) }}" class="admin-input" placeholder="INR">
                @error('currency_symbol') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="admin-label" for="footer_text">Footer Line</label>
                <input id="footer_text" name="footer_text" value="{{ old('footer_text', $settings->footer_text) }}" class="admin-input" placeholder="Fresh groceries delivered daily.">
                @error('footer_text') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="mt-4 grid gap-4">
            <div>
                <label class="admin-label" for="meta_title">Default Meta Title</label>
                <input id="meta_title" name="meta_title" value="{{ old('meta_title', $settings->meta_title) }}" class="admin-input">
                @error('meta_title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="admin-label" for="meta_description">Default Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="3" class="admin-textarea">{{ old('meta_description', $settings->meta_description) }}</textarea>
                @error('meta_description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="admin-label" for="meta_keywords">Meta Keywords</label>
                <textarea id="meta_keywords" name="meta_keywords" rows="2" class="admin-textarea">{{ old('meta_keywords', $settings->meta_keywords) }}</textarea>
                @error('meta_keywords') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </section>

    <section class="admin-panel p-6">
        <h2 class="text-lg font-semibold text-slate-900">Contact Details</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div>
                <label class="admin-label" for="support_email">Support Email</label>
                <input id="support_email" name="support_email" type="email" value="{{ old('support_email', $settings->support_email) }}" class="admin-input">
                @error('support_email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="admin-label" for="support_phone">Support Phone</label>
                <input id="support_phone" name="support_phone" value="{{ old('support_phone', $settings->support_phone) }}" class="admin-input">
                @error('support_phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="admin-label" for="whatsapp_number">WhatsApp Number</label>
                <input id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}" class="admin-input" placeholder="919876543210">
                @error('whatsapp_number') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="admin-label" for="erp_webform_url">ERP Webform URL</label>
                <input id="erp_webform_url" name="erp_webform_url" value="{{ old('erp_webform_url', $settings->erp_webform_url) }}" class="admin-input" placeholder="https://example.com/webform">
                @error('erp_webform_url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="mt-4">
            <label class="admin-label" for="contact_address">Address</label>
            <textarea id="contact_address" name="contact_address" rows="3" class="admin-textarea">{{ old('contact_address', $settings->contact_address) }}</textarea>
            @error('contact_address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </section>

    <section class="admin-panel p-6">
        <h2 class="text-lg font-semibold text-slate-900">Integrations</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div>
                <label class="admin-label" for="google_analytics_id">Google Analytics ID</label>
                <input id="google_analytics_id" name="google_analytics_id" value="{{ old('google_analytics_id', $settings->google_analytics_id) }}" class="admin-input" placeholder="G-XXXXXXXXXX">
                @error('google_analytics_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div class="grid gap-4">
                <div>
                    <label class="admin-label" for="facebook_url">Facebook URL</label>
                    <input id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}" class="admin-input">
                    @error('facebook_url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="admin-label" for="instagram_url">Instagram URL</label>
                    <input id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}" class="admin-input">
                    @error('instagram_url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="admin-label" for="youtube_url">YouTube URL</label>
                    <input id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $settings->youtube_url) }}" class="admin-input">
                    @error('youtube_url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </section>

    <section class="admin-panel p-6">
        <h2 class="text-lg font-semibold text-slate-900">Captcha Security</h2>
        <div class="mt-4 space-y-4">
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="captcha_enabled" value="1" @checked(old('captcha_enabled', $settings->captcha_enabled)) class="rounded border-slate-300">
                Enable Google reCAPTCHA on contact form
            </label>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="admin-label" for="captcha_site_key">Captcha Site Key</label>
                    <input id="captcha_site_key" name="captcha_site_key" value="{{ old('captcha_site_key', $settings->captcha_site_key) }}" class="admin-input">
                    @error('captcha_site_key') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="admin-label" for="captcha_secret_key">Captcha Secret Key</label>
                    <input id="captcha_secret_key" name="captcha_secret_key" value="{{ old('captcha_secret_key', $settings->captcha_secret_key) }}" class="admin-input">
                    @error('captcha_secret_key') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </section>

    <div class="flex justify-end">
        <button type="submit" class="btn-primary">Save Settings</button>
    </div>
</form>
@endsection
