<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('is_active', true)->with('category', 'images');

        if ($request->filled('category')) {
            $categorySlug = $request->string('category')->toString();
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $sort = $request->string('sort', 'latest')->toString();
        if ($sort === 'price_low') {
            $query->orderBy('price');
        } elseif ($sort === 'price_high') {
            $query->orderByDesc('price');
        } else {
            $query->latest();
        }

        return view('shop.index', [
            'categories' => Category::where('is_active', true)->get(),
            'products' => $query->paginate(12)->withQueryString(),
            'activeCategory' => $request->string('category')->toString(),
            'search' => $request->string('search')->toString(),
            'sort' => $sort,
        ]);
    }
}
