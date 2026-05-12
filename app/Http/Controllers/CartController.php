<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }
    
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'color' => 'nullable|string'
        ]);
        
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        
        $cartKey = $product->id . '_' . $request->size . '_' . $request->color;
        
        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $request->quantity;
        } else {
            $cart[$cartKey] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'size' => $request->size,
                'color' => $request->color,
                'image' => $product->images ? $product->images[0] : null
            ];
        }
        
        session()->put('cart', $cart);
        
        $cartCount = array_sum(array_column($cart, 'quantity'));
        
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart!',
            'cart_count' => $cartCount
        ]);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$request->key])) {
            $cart[$request->key]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            
            $cartCount = array_sum(array_column($cart, 'quantity'));
            $subtotal = array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));
            
            return response()->json([
                'success' => true,
                'message' => 'Cart updated!',
                'cart_count' => $cartCount,
                'subtotal' => $subtotal
            ]);
        }
        
        return response()->json(['success' => false, 'message' => 'Item not found!']);
    }
    
    public function remove(Request $request)
    {
        $request->validate([
            'key' => 'required|string'
        ]);
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$request->key])) {
            unset($cart[$request->key]);
            session()->put('cart', $cart);
            
            $cartCount = array_sum(array_column($cart, 'quantity'));
            
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart!',
                'cart_count' => $cartCount
            ]);
        }
        
        return response()->json(['success' => false, 'message' => 'Item not found!']);
    }
}