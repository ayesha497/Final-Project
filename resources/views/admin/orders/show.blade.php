@extends('admin.layouts.app')

@section('title', 'Order Details')
@section('header', 'Order Details: ' . $order->order_number)

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="table-card">
            <h5 class="fw-bold mb-3" style="color: #1A0B2E;">
                <i class="fas fa-user me-2" style="color: #6B46C1;"></i>Customer Information
            </h5>
            <table class="table table-borderless">
                <tr><th width="120">Name:</th><td><strong>{{ $order->customer_name }}</strong></td></tr>
                <tr><th>Email:</th><td>{{ $order->customer_email }}</td></tr>
                <tr><th>Phone:</th><td>{{ $order->customer_phone }}</td></tr>
                <tr><th>Address:</th><td>{{ $order->customer_address }}</td></tr>
            </table>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="table-card">
            <h5 class="fw-bold mb-3" style="color: #1A0B2E;">
                <i class="fas fa-info-circle me-2" style="color: #6B46C1;"></i>Order Information
            </h5>
            <table class="table table-borderless">
                <tr><th width="120">Order Date:</th><td>{{ $order->created_at->format('F d, Y h:i A') }}</td></tr>
                <tr><th>Payment Method:</th><td><span class="badge" style="background: #E8F5E9; color: #4CAF50;">Cash on Delivery</span></td></tr>
                <tr><th>Order Status:</th>
                    <td>
                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="order_status" class="form-select d-inline w-auto" onchange="this.form.submit()" style="border-radius: 50px;">
                                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <tr><th>Total Amount:</th><td><h4 class="fw-bold" style="color: #6B46C1;">${{ number_format($order->total_amount, 2) }}</h4></td></tr>
            </table>
        </div>
    </div>
</div>

<div class="table-card mt-4">
    <h5 class="fw-bold mb-3" style="color: #1A0B2E;">
        <i class="fas fa-boxes me-2" style="color: #6B46C1;"></i>Order Items
    </h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead style="background: #FAF5FF;">
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>
                        @if($item->product_image)
                            <img src="{{ asset('storage/' . $item->product_image) }}" width="50" height="50" style="object-fit: cover; border-radius: 10px;">
                        @else
                            <div style="width: 50px; height: 50px; background: #FAF5FF; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="color: #D6BCFA;"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $item->product_name }}</td>
                    <td>{{ $item->size ?? 'N/A' }}</td>
                    <td>{{ $item->color ?? 'N/A' }}</td>
                    <td>${{ number_format($item->product_price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td class="fw-bold" style="color: #6B46C1;">${{ number_format($item->product_price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot style="background: #FAF5FF;">
                <tr>
                    <th colspan="6" class="text-end">Total:</th>
                    <th class="fw-bold" style="color: #6B46C1;">${{ number_format($order->total_amount, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Back to Orders
    </a>
    <a href="mailto:{{ $order->customer_email }}" class="btn btn-primary">
        <i class="fas fa-envelope me-2"></i> Email Customer
    </a>
</div>
@endsection