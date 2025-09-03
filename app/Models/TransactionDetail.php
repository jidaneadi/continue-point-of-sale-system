<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'photo_session_id',
        'discount_id',
        'photographer_id',
        'price',
        'total',
        'link',
        'status',
        'schedule',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function photoSession()
    {
        return $this->belongsTo(PhotoSession::class, 'photo_session_id');
    }

    public function photographer()
    {
        return $this->belongsTo(Photographer::class, 'photographer_id');
    }
}
