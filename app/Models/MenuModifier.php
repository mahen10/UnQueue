<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModifier extends Model
{
    protected $fillable = [
        'menu_item_id',
        'name',
        'is_required',
        'options',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_required' => 'boolean',
            'options'     => 'array',
        ];
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
