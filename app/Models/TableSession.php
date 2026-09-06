<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TableSession extends Model
{
    protected $fillable = [
        'table_id',
        'session_token',
        'started_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at'   => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (TableSession $session) {
            if (empty($session->session_token)) {
                $session->session_token = Str::random(32);
            }
        });
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isActive(): bool
    {
        return $this->ended_at === null;
    }

    public function end(): void
    {
        $this->update(['ended_at' => now()]);
    }
}
