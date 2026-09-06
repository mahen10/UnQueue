<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'name',
        'number',
        'qr_token',
        'status',
    ];

    /**
     * Auto-generate QR token unik saat meja baru dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function (Table $table) {
            if (empty($table->qr_token)) {
                $table->qr_token = static::generateQrToken();
            }
        });
    }

    protected static function generateQrToken(): string
    {
        do {
            $token = Str::random(10);
        } while (static::where('qr_token', $token)->exists());

        return $token;
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function sessions()
    {
        return $this->hasMany(TableSession::class);
    }

    public function activeSession()
    {
        return $this->hasOne(TableSession::class)->whereNull('ended_at')->latest();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * URL QR Code pendek untuk pelanggan.
     */
    public function getQrUrlAttribute(): string
    {
        return url("/t/{$this->qr_token}");
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    public function isOccupied(): bool
    {
        return $this->status === 'occupied';
    }

    public function needsCleaning(): bool
    {
        return $this->status === 'dirty';
    }
}
