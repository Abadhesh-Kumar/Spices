<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\ContactLead;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Schema::hasTable('banners')
            ? Banner::where('is_active', true)->orderBy('sort_order')->get()
            : collect();

        $categories = Schema::hasTable('categories')
            ? Category::where('is_active', true)->take(6)->get()
            : collect();

        $featuredProducts = Schema::hasTable('products')
            ? Product::where('is_active', true)->where('is_featured', true)->with('category', 'images')->take(8)->get()
            : collect();

        $bestSellers = Schema::hasTable('products')
            ? Product::where('is_active', true)->where('is_best_seller', true)->with('category', 'images')->take(6)->get()
            : collect();

        $newArrivals = Schema::hasTable('products')
            ? Product::where('is_active', true)->with('category', 'images')->latest()->take(6)->get()
            : collect();

        $blogPosts = Schema::hasTable('blog_posts')
            ? BlogPost::where('is_active', true)->latest('published_at')->take(3)->get()
            : collect();

        $testimonials = Schema::hasTable('testimonials')
            ? Testimonial::where('is_active', true)->take(4)->get()
            : collect();

        return view('home', [
            'banners' => $banners,
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'bestSellers' => $bestSellers,
            'newArrivals' => $newArrivals,
            'blogPosts' => $blogPosts,
            'testimonials' => $testimonials,
        ]);
    }

    public function storeContactLead(Request $request)
    {
        $settings = Schema::hasTable('site_settings') ? SiteSetting::current() : null;

        if ($settings?->captcha_enabled && $settings->captcha_secret_key) {
            $captchaResponse = $request->input('g-recaptcha-response');

            if (!$captchaResponse) {
                return back()
                    ->withInput()
                    ->withErrors(['captcha' => 'Please complete captcha verification.']);
            }

            $captchaVerification = Http::asForm()
                ->timeout(10)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $settings->captcha_secret_key,
                    'response' => $captchaResponse,
                    'remoteip' => $request->ip(),
                ]);

            if (!$captchaVerification->ok() || !$captchaVerification->json('success')) {
                return back()
                    ->withInput()
                    ->withErrors(['captcha' => 'Captcha verification failed. Please try again.']);
            }
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'product_service' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        $lead = ContactLead::create($data);

        $erpUrl = $settings?->erp_webform_url ?: config('services.erp.webform_url');
        if ($erpUrl) {
            $postData = [
                "manager_id"       => 0,
                "pipeline_id"      => 14,
                "source_id"        => 46,
                "name"             => "Web Form",
                "contact_name"     => $data['name'],
                "contact_phone"    => $data['phone'] ?? '',
                "contact_email"    => $data['email'],
                "contact_company"  => $data['company'] ?? '',
                "Product/service"  => $data['product_service'] ?? '',
                "description"      => $data['message'] ?? '',
            ];

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $erpUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query($postData),
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/x-www-form-urlencoded"
                ],
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT => 15,
            ]);

            $response = curl_exec($ch);
            $error = curl_error($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $lead->erp_status = $error ? false : ($httpCode >= 200 && $httpCode < 300);
            $lead->erp_http_code = $httpCode ?: null;
            $lead->erp_response = $error ? $error : $response;
            $lead->save();
        }

        return back()->with('success', 'Thanks! We received your message.');
    }
}
