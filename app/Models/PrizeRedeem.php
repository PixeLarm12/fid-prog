<?php

namespace App\Models;

use App\Services\PrizeService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PrizeRedeem extends Model
{
    protected $table = 'prize_redeems';

    protected $fillable = [
        'date',
        'user_id',
        'prize_id',
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

        static::created(function ($redeem) {
            $userService = new UserService();
            $prizeService = new PrizeService();

            $user = $userService->findRecord($redeem->user_id);
            $prize = $prizeService->findRecord($redeem->prize_id);

            if($user) {
                $user->update([
                    'fidelity_points' => $user->fidelity_points - $prize->points
                ]);
            }
        });
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function prize() : HasOne
    {
        return $this->hasOne(Prize::class);
    }
}
