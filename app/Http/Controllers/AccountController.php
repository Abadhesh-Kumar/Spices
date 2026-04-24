<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function orders(Request $request)
    {
        return view('account.orders', [
            'orders' => Order::where('user_id', $request->user()->id)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function track(Request $request)
    {
        $order = null;
        if ($request->filled('order_number')) {
            $order = Order::where('order_number', $request->string('order_number'))
                ->first();
        }

        return view('account.track', [
            'order' => $order,
        ]);
    }
}
