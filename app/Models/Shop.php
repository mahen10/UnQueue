<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'logo',
        'address',
        'phone',
        'open_time',
        'close_time',
        'tax_percent',
        'service_charge_percent',
        'subscription_end_date',
        'subscription_override',
        'xendit_public_key',
        'xendit_secret_key',
        'xendit_webhook_token',
    ];

    protected function casts(): array
    {
        return [
            'subscription_end_date'        => 'datetime',
            'tax_percent'                  => 'decimal:2',
            'service_charge_percent'       => 'decimal:2',
        ];
    }

    // ─── Relationships ──────────────────────────────────────────────────────────

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function shopUsers()
    {
        return $this->hasMany(ShopUser::class);
    }

    public function staff()
    {
        return $this->belongsToMany(User::class, 'shop_users')
            ->withPivot(['role', 'status', 'joined_at'])
            ->withTimestamps();
    }

    public function invitations()
    {
        return $this->hasMany(StaffInvitation::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class)->orderBy('sort_order');
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class)->orderBy('number');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class)->latest();
    }

    // ─── Subscription Helpers ────────────────────────────────────────────────────

    /**
     * Cek apakah toko aktif (berlangganan atau di-override aktif).
     * Ini adalah satu-satunya method yang boleh dipakai untuk cek status di Middleware.
     */
    public function isSubscriptionActive(): bool
    {
        // Override oleh Super Admin — prioritas tertinggi
        if ($this->subscription_override === 'active') {
            return true;
        }

        if ($this->subscription_override === 'suspended') {
            return false;
        }

        // NULL = ikuti tanggal subscription biasa
        return $this->subscription_end_date !== null
            && $this->subscription_end_date->isFuture();
    }

    public function isSubscriptionExpired(): bool
    {
        return ! $this->isSubscriptionActive();
    }

    public function subscriptionDaysLeft(): int
    {
        if ($this->subscription_override === 'active') {
            return 999; // simbol "aktif tanpa batas" untuk testing
        }

        if (! $this->subscription_end_date || $this->isSubscriptionExpired()) {
            return 0;
        }

        return (int) now()->diffInDays($this->subscription_end_date, false);
    }
}
