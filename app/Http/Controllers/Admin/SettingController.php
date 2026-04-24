<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit', [
            'settings' => SiteSetting::current(),
        ]);
    }

    public function update(Request $request)
    {
        $settings = SiteSetting::current();

        $data = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'support_email' => ['nullable', 'email', 'max:255'],
            'support_phone' => ['nullable', 'string', 'max:40'],
            'whatsapp_number' => ['nullable', 'string', 'max:40'],
            'contact_address' => ['nullable', 'string'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'google_analytics_id' => ['nullable', 'string', 'max:60'],
            'captcha_enabled' => ['nullable', 'boolean'],
            'captcha_site_key' => ['nullable', 'string', 'max:255', 'required_if:captcha_enabled,1'],
            'captcha_secret_key' => ['nullable', 'string', 'max:255', 'required_if:captcha_enabled,1'],
            'erp_webform_url' => ['nullable', 'string', 'max:255'],
            'footer_text' => ['nullable', 'string', 'max:255'],
            'currency_symbol' => ['nullable', 'string', 'max:10'],
        ]);

        $settings->fill($data);
        $settings->captcha_enabled = $request->boolean('captcha_enabled');
        $settings->save();

        SiteSetting::flushCache();

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Settings updated successfully.');
    }
}
