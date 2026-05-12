@extends('admin.layouts.app')

@section('title', 'User Details')
@section('header', 'User Details: ' . $user->name)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="table-card">
            <h5 class="mb-3">User Information</h5>
            <table class="table table-borderless">
                <tr><th>Name:</th><td>{{ $user->name }}</td></tr>
                <tr><th>Email:</th><td>{{ $user->email }}</td></tr>
                <tr><th>Registered:</th> <td>{{ $user->created_at->format('F d, Y h:i A') }}</td></tr>
                <tr><th>Total Orders:</th> <td><span class="badge bg-primary">{{ $user->orders->count() }} Orders</span></td></tr>
            </table>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="table-card">
            <h5 class="mb-3">Order History</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($user->orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $order->order_status == 'pending' ? 'warning' : ($order->order_status == 'delivered' ? 'success' : 'info') }}">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View Order</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Users</a>
</div>
@endsection