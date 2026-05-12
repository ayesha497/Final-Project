<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand_name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        $products = $query->paginate(12);
        $categories = Product::distinct()->pluck('category');
        
        return view('products.index', compact('products', 'categories'));
    }
    
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('category', $product->category)
                                 ->where('id', '!=', $id)
                                 ->limit(4)
                                 ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
}