<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffInvitation extends Model
{
    protected $fillable = [
        'shop_id',
        'invited_by',
        'uq_id',
        'role',
        'status',
        'responded_at',
    ];

    protected function casts(): array
    {
        return [
            'responded_at' => 'datetime',
        ];
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    /**
     * Cari user berdasarkan UQ-ID yang diundang.
     */
    public function invitedUser()
    {
        return $this->hasOne(User::class, 'uq_id', 'uq_id');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
