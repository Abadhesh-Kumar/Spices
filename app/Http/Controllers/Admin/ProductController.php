<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::with('category')->latest()->paginate(12),
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'is_featured' => 'sometimes|boolean',
            'is_best_seller' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'discount_price' => $data['discount_price'] ?? null,
            'stock' => $data['stock'],
            'description' => $data['description'] ?? null,
            'ingredients' => $data['ingredients'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_best_seller' => $request->boolean('is_best_seller'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path' => 'storage/' . $path,
                'alt' => $product->name,
                'sort_order' => 0,
            ]);
        }

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product->load('images'),
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'is_featured' => 'sometimes|boolean',
            'is_best_seller' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $product->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'discount_price' => $data['discount_price'] ?? null,
            'stock' => $data['stock'],
            'description' => $data['description'] ?? null,
            'ingredients' => $data['ingredients'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_best_seller' => $request->boolean('is_best_seller'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path' => 'storage/' . $path,
                'alt' => $product->name,
                'sort_order' => 0,
            ]);
        }

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
