<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('success', 'Your cart is empty.');
        }

        return view('checkout.index', [
            'cart' => $cart,
            'coupon' => session()->get('cart_coupon'),
            'totals' => $this->calculateTotals($cart, session()->get('cart_coupon')),
        ]);
    }

    public function place(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'payment_method' => 'required|in:razorpay,cod',
        ]);

        $totals = $this->calculateTotals($cart, session()->get('cart_coupon'));
        $order = Order::create([
            'user_id' => $request->user()?->id,
            'order_number' => 'TF-' . strtoupper(Str::random(10)),
            'status' => 'processing',
            'payment_method' => $data['payment_method'],
            'payment_status' => $data['payment_method'] === 'razorpay' ? 'pending' : 'unpaid',
            'subtotal' => $totals['subtotal'],
            'discount' => $totals['discount'],
            'shipping' => $totals['shipping'],
            'total' => $totals['total'],
            'customer_name' => $data['name'],
            'customer_email' => $data['email'],
            'customer_phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'pincode' => $data['pincode'],
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');
        session()->forget('cart_coupon');

        return redirect()->route('checkout.thankyou', $order);
    }

    public function thankyou(Order $order)
    {
        return view('checkout.thankyou', [
            'order' => $order,
        ]);
    }

    private function calculateTotals(array $cart, ?array $coupon): array
    {
        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $discount = 0;

        if ($coupon && (!$coupon['min_amount'] || $subtotal >= $coupon['min_amount'])) {
            if ($coupon['type'] === 'percent') {
                $discount = $subtotal * ($coupon['value'] / 100);
            } else {
                $discount = $coupon['value'];
            }
        }

        $shipping = $subtotal >= 799 ? 0 : 59;
        $total = max(0, $subtotal - $discount + $shipping);

        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping' => $shipping,
            'total' => $total,
        ];
    }
}
