<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'products_id',
        'customers_id',
        'jumlah',
        'photo_session_id',
        'schedule'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }
}
