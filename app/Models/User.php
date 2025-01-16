<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'fidelity_points'
    ];

    protected $hidden = [
        'password'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (is_null($user->fidelity_points)) {
                $user->fidelity_points = 0;
            }
        });
    }

    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function redeemed() : HasMany
    {
        return $this->hasMany(PrizeRedeem::class);
    }
}
