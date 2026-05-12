<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::latest()->take(8)->get();
        
        // Process images for each product
        foreach ($featuredProducts as $product) {
            if ($product->images && is_string($product->images)) {
                $product->images = json_decode($product->images, true);
            }
            if (!$product->images || !is_array($product->images)) {
                $product->images = [];
            }
        }
        
        return view('home', compact('featuredProducts'));
    }
}