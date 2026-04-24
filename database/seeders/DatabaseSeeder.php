<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@tradifoods.test',
            'phone' => '9999999999',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $categories = collect([
            'Traditional Spices',
            'Cold Pressed Oils',
            'Dry Vegetables',
            'Pickles & Condiments',
            'Organic Products',
        ])->map(function ($name) {
            return Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Authentic small-batch products crafted with regional techniques.',
                'image' => null,
                'is_active' => true,
            ]);
        });

        $products = [
            [
                'name' => 'Royal Garam Masala',
                'category' => 'Traditional Spices',
                'price' => 320,
                'discount_price' => 279,
                'stock' => 120,
                'is_best_seller' => true,
                'description' => 'Warm, layered spices roasted and ground for everyday cooking.',
                'ingredients' => 'Coriander, cumin, cloves, cinnamon, cardamom, black pepper.',
            ],
            [
                'name' => 'Cold Pressed Mustard Oil',
                'category' => 'Cold Pressed Oils',
                'price' => 540,
                'discount_price' => 499,
                'stock' => 80,
                'is_best_seller' => true,
                'description' => 'Slow-pressed in small batches for bold aroma and richness.',
                'ingredients' => 'Single origin mustard seeds.',
            ],
            [
                'name' => 'Sun-Dried Ker',
                'category' => 'Dry Vegetables',
                'price' => 420,
                'discount_price' => 389,
                'stock' => 60,
                'is_best_seller' => false,
                'description' => 'Traditionally sun-dried ker for signature Rajasthani curries.',
                'ingredients' => 'Wild ker, natural salt.',
            ],
            [
                'name' => 'Lemon Chili Pickle',
                'category' => 'Pickles & Condiments',
                'price' => 260,
                'discount_price' => 229,
                'stock' => 95,
                'is_best_seller' => false,
                'description' => 'Zesty lemon pickle with a bright, spicy finish.',
                'ingredients' => 'Lemon, chili, mustard oil, spices.',
            ],
            [
                'name' => 'Stone-Ground Turmeric',
                'category' => 'Traditional Spices',
                'price' => 210,
                'discount_price' => 189,
                'stock' => 150,
                'is_best_seller' => true,
                'description' => 'High-curcumin turmeric for color and depth.',
                'ingredients' => 'Single estate turmeric.',
            ],
            [
                'name' => 'Organic Jaggery Powder',
                'category' => 'Organic Products',
                'price' => 180,
                'discount_price' => 165,
                'stock' => 140,
                'is_best_seller' => false,
                'description' => 'Naturally processed jaggery with caramel notes.',
                'ingredients' => 'Organic sugarcane juice.',
            ],
        ];

        foreach ($products as $productData) {
            $category = $categories->firstWhere('name', $productData['category']);
            $product = Product::create([
                'category_id' => $category->id,
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'sku' => 'TF-' . strtoupper(Str::random(6)),
                'description' => $productData['description'],
                'ingredients' => $productData['ingredients'],
                'price' => $productData['price'],
                'discount_price' => $productData['discount_price'],
                'stock' => $productData['stock'],
                'is_best_seller' => $productData['is_best_seller'],
                'is_featured' => true,
                'is_active' => true,
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'path' => 'images/products/placeholder-1.svg',
                'alt' => $product->name,
                'sort_order' => 0,
            ]);
        }

        Banner::insert([
            [
                'title' => 'Heritage Pantry, Modern Convenience',
                'subtitle' => 'Small-batch staples from Rajasthan and beyond.',
                'image' => 'images/banners/banner-1.svg',
                'cta_text' => 'Shop Best Sellers',
                'cta_url' => '/shop',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Freshly Ground, Deeply Aromatic',
                'subtitle' => 'Spice blends made to order every week.',
                'image' => 'images/banners/banner-2.svg',
                'cta_text' => 'Explore Spices',
                'cta_url' => '/shop?category=traditional-spices',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ]);

        BlogPost::insert([
            [
                'title' => 'Cooking With Cold-Pressed Oils',
                'slug' => 'cooking-with-cold-pressed-oils',
                'excerpt' => 'How traditional extraction keeps flavors bold and nutrients intact.',
                'body' => 'Cold pressing preserves the aroma of seeds and the integrity of the oil. Use lower heat and finish dishes with a drizzle for layered flavor.',
                'cover_image' => 'images/blog/blog-1.svg',
                'is_active' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Three Rajasthani Winter Staples',
                'slug' => 'rajasthani-winter-staples',
                'excerpt' => 'Ker, sangri, and kumatiya - pantry essentials with a long shelf life.',
                'body' => 'Dry vegetables have been part of desert cuisine for centuries. Rehydrate, simmer, and finish with a bright, spicy tadka for a comforting meal.',
                'cover_image' => 'images/blog/blog-2.svg',
                'is_active' => true,
                'published_at' => now()->subDays(14),
            ],
        ]);

        Testimonial::insert([
            [
                'name' => 'Meera Joshi',
                'role' => 'Home Chef, Jaipur',
                'body' => 'The spice blends smell like the masalas my grandmother used to grind. The freshness is noticeable.',
                'avatar' => 'images/testimonials/avatar-1.svg',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Rohit Sharma',
                'role' => 'Restaurant Owner',
                'body' => 'Great consistency and careful packaging. Our team switched to their cold-pressed oils this season.',
                'avatar' => 'images/testimonials/avatar-2.svg',
                'rating' => 5,
                'is_active' => true,
            ],
        ]);
    }
}
