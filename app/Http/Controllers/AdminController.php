<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Admin;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ==================== AUTHENTICATION ====================

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, ' . $admin->name . '!');
        }

        return back()->with('error', 'Invalid credentials!');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }

    // ==================== DASHBOARD ====================

    public function dashboard()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalMessages = ContactMessage::count();
        $totalUsers = User::count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $recentOrders = Order::latest()->take(5)->get();
        $recentMessages = ContactMessage::where('is_read', false)->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalMessages',
            'totalUsers',
            'pendingOrders',
            'recentOrders',
            'recentMessages'
        ));
    }

    // ==================== PRODUCT MANAGEMENT ====================

    public function products(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $products = Product::latest()->paginate(10);
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalMessages = ContactMessage::count();
        $totalUsers = User::count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $recentOrders = Order::latest()->take(5)->get();
        $recentMessages = ContactMessage::where('is_read', false)->latest()->take(5)->get();
        return view('admin.products.index', compact('products', 'totalProducts', 'totalOrders', 'totalMessages', 'totalUsers', 'pendingOrders', 'recentOrders', 'recentMessages'));
    }

    
    public function productCreate()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $categories = ['Men\'s Fashion', 'Women\'s Fashion', 'Kids Wear', 'Footwear', 'Accessories'];
        $sizesOptions = ['S', 'M', 'L', 'XL', 'XXL', '30', '32', '34', '36', '38', '7', '8', '9', '10', '11'];
        $colors = ['Red', 'Blue', 'Green', 'Black', 'White', 'Yellow', 'Pink', 'Purple', 'Brown', 'Navy'];

        return view('admin.products.create', compact('categories', 'sizesOptions', 'colors'));
    }

    public function productStore(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'brand_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'sizes' => 'required|array',
            'color' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        Product::create([
            'brand_name' => $request->brand_name,
            'name' => $request->name,
            'category' => $request->category,
            'sizes' => $request->sizes,
            'color' => $request->color,
            'description' => $request->description,
            'price' => $request->price,
            'images' => $imagePaths
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function productEdit($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $product = Product::findOrFail($id);
        $categories = ['Men\'s Fashion', 'Women\'s Fashion', 'Kids Wear', 'Footwear', 'Accessories'];
        $sizesOptions = ['S', 'M', 'L', 'XL', 'XXL', '30', '32', '34', '36', '38', '7', '8', '9', '10', '11'];
        $colors = ['Red', 'Blue', 'Green', 'Black', 'White', 'Yellow', 'Pink', 'Purple', 'Brown', 'Navy'];

        return view('admin.products.edit', compact('product', 'categories', 'sizesOptions', 'colors'));
    }

    public function productUpdate(Request $request, $id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $product = Product::findOrFail($id);

        $request->validate([
            'brand_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'sizes' => 'required|array',
            'color' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePaths = $product->images ?? [];

        if ($request->hasFile('images')) {
            // Delete old images
            foreach ($imagePaths as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        $product->update([
            'brand_name' => $request->brand_name,
            'name' => $request->name,
            'category' => $request->category,
            'sizes' => $request->sizes,
            'color' => $request->color,
            'description' => $request->description,
            'price' => $request->price,
            'images' => $imagePaths
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function productDestroy($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $product = Product::findOrFail($id);

        // Delete images
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    // ==================== ORDER MANAGEMENT ====================

    public function orders(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function orderShow($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function orderUpdateStatus(Request $request, $id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'order_status' => $request->order_status
        ]);

        return redirect()->route('admin.orders.show', $id)->with('success', 'Order status updated successfully!');
    }

    // ==================== USER MANAGEMENT ====================

    public function users(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $users = User::withCount('orders')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function userShow($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $user = User::with('orders.orderItems')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function userDestroy($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }

    // ==================== ADMIN MANAGEMENT ====================

    public function admins(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $admins = Admin::latest()->paginate(10);
        return view('admin.admins.index', compact('admins'));
    }

    public function adminCreate()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return view('admin.admins.create');
    }

    public function adminStore(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6'
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.admins')->with('success', 'Admin created successfully!');
    }

    public function adminDestroy($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        // Prevent deleting yourself
        if ($id == Auth::guard('admin')->id()) {
            return redirect()->route('admin.admins')->with('error', 'You cannot delete your own account!');
        }

        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.admins')->with('success', 'Admin deleted successfully!');
    }

    // ==================== MESSAGES MANAGEMENT ====================

    public function messages(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function messageShow($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $message = ContactMessage::findOrFail($id);

        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function messageDestroy($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages')->with('success', 'Message deleted successfully!');
    }
}