<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Order::where('payment_status', '!=', 'failed')->sum('total');

        return view('admin.dashboard', [
            'totalOrders' => Order::count(),
            'totalUsers' => User::count(),
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'totalSales' => $totalSales,
            'recentOrders' => Order::latest()->take(6)->get(),
        ]);
    }
}
