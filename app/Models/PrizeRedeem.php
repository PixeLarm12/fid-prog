<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PrizeRedeem extends Model
{
    protected $table = 'prize_redeems';

    protected $fillable = [
        'date',
        'redeemed',
        'user_id',
        'prize_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function prize() : HasOne
    {
        return $this->hasOne(Prize::class);
    }
}
