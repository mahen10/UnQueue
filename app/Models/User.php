<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'uq_id',
        'name',
        'phone',
        'email',
        'password',
        'is_banned',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_banned'         => 'boolean',
        ];
    }

    /**
     * Auto-generate UQ-ID saat user baru dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if (empty($user->uq_id)) {
                $user->uq_id = static::generateUqId();
            }
        });
    }

    /**
     * Generate UQ-ID unik: format UQ + 6 angka.
     */
    protected static function generateUqId(): string
    {
        do {
            $id = 'UQ' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (static::where('uq_id', $id)->exists());

        return $id;
    }

    // ─── Relationships ──────────────────────────────────────────────────────────

    public function ownedShops()
    {
        return $this->hasMany(Shop::class, 'owner_id');
    }

    public function shopUsers()
    {
        return $this->hasMany(ShopUser::class);
    }

    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'shop_users')
            ->withPivot(['role', 'status', 'joined_at'])
            ->withTimestamps();
    }

    public function sentInvitations()
    {
        return $this->hasMany(StaffInvitation::class, 'invited_by');
    }

    // ─── Helpers ────────────────────────────────────────────────────────────────

    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin ?? false;
    }

    public function isBanned(): bool
    {
        return (bool) $this->is_banned;
    }

    public function activeShop(): ?Shop
    {
        return $this->ownedShops()->first()
            ?? $this->shops()->wherePivot('status', 'active')->first();
    }
}
