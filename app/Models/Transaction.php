<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'total',
        'date',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($transaction) {
            $user = User::find($transaction->user_id);

            if($user) {
                $points = floor($transaction->total / 5);
        
                $user->update([
                    'fidelity_points' => $user->fidelity_points + $points
                ]);
            }
        });
    }


    public function items() : HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
