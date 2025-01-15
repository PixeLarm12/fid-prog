<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransactionItem extends Model
{
    protected $table = "transaction_items";

    protected $fillable = [
        'transaction_id',
        'product_id',
        'unit_price',
        'amount',
        'total_price',
    ];

    public function transaction() : BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product() : HasOne
    {
        return $this->hasOne(Product::class);
    }
}
