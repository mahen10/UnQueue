<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'menu_item_id',
        'item_name',
        'item_price',
        'quantity',
        'modifiers',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'item_price' => 'decimal:2',
            'modifiers'  => 'array',
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    /**
     * Total harga item ini (harga satuan + modifier) × qty.
     */
    public function getSubtotalAttribute(): float
    {
        $modifierTotal = collect($this->modifiers ?? [])
            ->sum('price');

        return ($this->item_price + $modifierTotal) * $this->quantity;
    }
}
