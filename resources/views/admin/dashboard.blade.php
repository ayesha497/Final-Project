@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<!-- Stats Row -->
<div class="row g-4">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Products</p>
                    <h2 class="mb-0 fw-bold" style="color: #1A0B2E;">{{ $totalProducts ?? 0 }}</h2>
                </div>
                <div class="stats-icon" style="background: rgba(107, 70, 193, 0.1);">
                    <i class="fas fa-box" style="color: #6B46C1;"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Orders</p>
                    <h2 class="mb-0 fw-bold" style="color: #1A0B2E;">{{ $totalOrders ?? 0 }}</h2>
                </div>
                <div class="stats-icon" style="background: rgba(159, 122, 234, 0.1);">
                    <i class="fas fa-shopping-cart" style="color: #9F7AEA;"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Users</p>
                    <h2 class="mb-0 fw-bold" style="color: #1A0B2E;">{{ $totalUsers ?? 0 }}</h2>
                </div>
                <div class="stats-icon" style="background: rgba(85, 60, 154, 0.1);">
                    <i class="fas fa-users" style="color: #553C9A;"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Pending Orders</p>
                    <h2 class="mb-0 fw-bold" style="color: #1A0B2E;">{{ $pendingOrders ?? 0 }}</h2>
                </div>
                <div class="stats-icon" style="background: rgba(245, 87, 108, 0.1);">
                    <i class="fas fa-clock" style="color: #F5576C;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts & Recent Activity -->
<div class="row g-4 mt-2">
    <div class="col-md-7">
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0" style="color: #1A0B2E;">
                    <i class="fas fa-chart-line me-2" style="color: #6B46C1;"></i>Recent Orders
                </h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 50px;">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead style="background: #FAF5FF;">
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($recentOrders ?? []) as $order)
                        <tr>
                            <td><span class="fw-semibold">{{ $order->order_number }}</span></td>
                            <td>{{ $order->customer_name }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <span class="badge-status" style="background: 
                                    @if($order->order_status == 'pending') #FFF3E0; color: #FF9800;
                                    @elseif($order->order_status == 'processing') #E3F2FD; color: #2196F3;
                                    @elseif($order->order_status == 'shipped') #E8EAF6; color: #3F51B5;
                                    @elseif($order->order_status == 'delivered') #E8F5E9; color: #4CAF50;
                                    @else #FFEBEE; color: #F44336;
                                    @endif">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-4">No orders found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-5">
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0" style="color: #1A0B2E;">
                    <i class="fas fa-envelope me-2" style="color: #6B46C1;"></i>Recent Messages
                </h5>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 50px;">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="message-list">
                @forelse(($recentMessages ?? []) as $message)
                <div class="d-flex align-items-center gap-3 p-3 border-bottom">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 45px; height: 45px; background: #FAF5FF;">
                            <i class="fas fa-user" style="color: #6B46C1;"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0 fw-semibold">{{ $message->name }}</h6>
                            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="small text-muted mb-0">{{ Str::limit($message->message, 50) }}</p>
                    </div>
                    @if(!$message->is_read)
                    <span class="badge bg-danger">New</span>
                    @endif
                </div>
                @empty
                <div class="text-center py-4">No messages found</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="table-card">
            <h5 class="fw-bold mb-4" style="color: #1A0B2E;">
                <i class="fas fa-bolt me-2" style="color: #6B46C1;"></i>Quick Actions
            </h5>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Add New Product
                </a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-shopping-cart me-2"></i> Manage Orders
                </a>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-envelope me-2"></i> View Messages
                </a>
                <a href="{{ route('admin.admins.create') }}" class="btn btn-outline-primary">
                    <i class="fas fa-user-plus me-2"></i> Add New Admin
                </a>
            </div>
        </div>
    </div>
</div>
@endsection