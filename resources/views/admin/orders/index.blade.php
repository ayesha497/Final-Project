@extends('admin.layouts.app')

@section('title', 'Orders Management')
@section('header', 'Orders Management')

@section('content')
<div class="table-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0" style="color: #1A0B2E;">
            <i class="fas fa-shopping-cart me-2" style="color: #6B46C1;"></i>All Orders
        </h5>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover" id="ordersTable">
            <thead style="background: #FAF5FF;">
                <tr>
                    <th>ID</th>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td><span class="fw-semibold">{{ $order->order_number }}</span></td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_email }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td class="fw-bold" style="color: #6B46C1;">${{ number_format($order->total_amount, 2) }}</td>
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
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info" style="border-radius: 10px;">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[0, 'desc']],
            language: {
                search: "Search orders:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ orders"
            }
        });
    });
</script>
@endpush
@endsection