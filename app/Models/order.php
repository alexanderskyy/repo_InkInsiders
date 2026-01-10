<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'customer_email',
        'shipping_address',
        'shipping_city',
        'shipping_zip',
        'payment_method',
        'total',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with OrderItems.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relationship with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted total (FIXED).
     */
    public function getFormattedTotalAttribute(): string
    {
        // Pastikan $this->total adalah number, bukan string
        $total = floatval($this->total);
        return 'Rp ' . number_format($total, 0, ',', '.');
    }

    /**
     * Get status badge color.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'processing' => 'blue',
            'paid' => 'green',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    /**
     * Get status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu Pembayaran',
            'processing' => 'Diproses',
            'paid' => 'Dibayar',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }
}