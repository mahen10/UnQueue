<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'shop_id',
        'amount',
        'period_start',
        'period_end',
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
            'period_start'     => 'datetime',
            'period_end'       => 'datetime',
            'gateway_response' => 'array',
            'paid_at'          => 'datetime',
        ];
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function isActive(): bool  { return $this->status === 'active'; }
    public function isPending(): bool { return $this->status === 'pending'; }
    public function isExpired(): bool { return $this->status === 'expired'; }
    public function isFailed(): bool  { return $this->status === 'failed'; }
}
