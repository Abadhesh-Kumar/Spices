<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'support_email',
        'support_phone',
        'whatsapp_number',
        'contact_address',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'google_analytics_id',
        'captcha_enabled',
        'captcha_site_key',
        'captcha_secret_key',
        'erp_webform_url',
        'footer_text',
        'currency_symbol',
    ];

    protected $casts = [
        'captcha_enabled' => 'boolean',
    ];

    public static function current(): self
    {
        return Cache::rememberForever('site_settings.current', function () {
            return static::query()->firstOrCreate([], [
                'site_name' => config('app.name', 'TradiFoods'),
                'site_tagline' => 'Heritage Pantry',
                'support_email' => 'hello@tradifoods.test',
                'support_phone' => '+91 90000 00000',
                'whatsapp_number' => '919000000000',
                'meta_keywords' => 'grocery, spices, cold pressed oils, dry vegetables, organic products',
                'google_analytics_id' => config('services.analytics.google_analytics_id'),
                'captcha_site_key' => config('services.captcha.site_key'),
                'captcha_secret_key' => config('services.captcha.secret_key'),
                'erp_webform_url' => config('services.erp.webform_url'),
                'currency_symbol' => 'INR',
            ]);
        });
    }

    public static function flushCache(): void
    {
        Cache::forget('site_settings.current');
    }
}
