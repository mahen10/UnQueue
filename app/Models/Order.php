<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'table_id',
        'table_session_id',
        'handled_by',
        'order_number',
        'type',
        'status',
        'subtotal',
        'tax_amount',
        'service_charge_amount',
        'total',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'subtotal'               => 'decimal:2',
            'tax_amount'             => 'decimal:2',
            'service_charge_amount'  => 'decimal:2',
            'total'                  => 'decimal:2',
        ];
    }

    // ─── Relationships ──────────────────────────────────────────────────────────

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function tableSession()
    {
        return $this->belongsTo(TableSession::class);
    }

    public function handledBy()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // ─── Status Helpers ──────────────────────────────────────────────────────────

    public function isPending(): bool   { return $this->status === 'pending'; }
    public function isPaid(): bool      { return $this->status === 'paid'; }
    public function isProcessing(): bool { return $this->status === 'processing'; }
    public function isReady(): bool     { return $this->status === 'ready'; }
    public function isDelivered(): bool { return $this->status === 'delivered'; }
    public function isCancelled(): bool { return $this->status === 'cancelled'; }

    // ─── Scopes ─────────────────────────────────────────────────────────────────

    public function scopeForShop($query, int $shopId)
    {
        return $query->where('shop_id', $shopId);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopePaid($query)
    {
        return $query->where('status', '!=', 'pending')
            ->where('status', '!=', 'cancelled');
    }
}
