<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'shop_id',
        'method',
        'amount',
        'status',
        'gateway_reference',
        'xendit_invoice_url',
        'gateway_response',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'amount'           => 'decimal:2',
            'gateway_response' => 'array',
            'paid_at'          => 'datetime',
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function isSuccess(): bool  { return $this->status === 'success'; }
    public function isPending(): bool  { return $this->status === 'pending'; }
    public function isFailed(): bool   { return $this->status === 'failed'; }
    public function isRefunded(): bool { return $this->status === 'refunded'; }
}
