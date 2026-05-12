<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products')->with('error', 'Your cart is empty!');
        }

        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'create_account' => 'nullable|boolean'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products')->with('error', 'Your cart is empty!');
        }

        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Create or get user
        $user = null;
        if ($request->create_account) {
            $user = User::create([
                'name' => $request->customer_name,
                'email' => $request->customer_email,
                'password' => Hash::make($request->password)
            ]);
        } else {
            $user = User::where('email', $request->customer_email)->first();
        }

        // Create order
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_amount' => $total,
            'user_id' => $user?->id,
            'payment_method' => 'cash_on_delivery',
            'order_status' => 'pending'
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'size' => $item['size'] ?? null,
                'color' => $item['color'] ?? null,
                'product_image' => $item['image'] ?? null
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('products')->with('success', 'Order placed successfully! Your order number is: ' . $order->order_number);
    }
}