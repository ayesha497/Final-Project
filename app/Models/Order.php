<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'total_amount',
        'user_id',
        'payment_method',
        'order_status'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2'
    ];

    // Generate unique order number
    public static function generateOrderNumber()
    {
        $orderNumber = 'ORD-' . strtoupper(uniqid());
        
        while (self::where('order_number', $orderNumber)->exists()) {
            $orderNumber = 'ORD-' . strtoupper(uniqid());
        }
        
        return $orderNumber;
    }

    // Relationship with order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Get order status badge
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'processing' => '<span class="badge bg-info">Processing</span>',
            'shipped' => '<span class="badge bg-primary">Shipped</span>',
            'delivered' => '<span class="badge bg-success">Delivered</span>',
            'cancelled' => '<span class="badge bg-danger">Cancelled</span>',
        ];
        
        return $badges[$this->order_status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    // Get payment method label
    public function getPaymentMethodLabelAttribute()
    {
        $methods = [
            'cash_on_delivery' => 'Cash on Delivery'
        ];
        
        return $methods[$this->payment_method] ?? $this->payment_method;
    }
}