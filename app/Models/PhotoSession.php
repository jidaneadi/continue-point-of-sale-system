<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoSession extends Model
{
    use HasFactory, HasUuids;
    
    protected $fillable = [
        'code',
        'name',
        'type',
        'start_time',
        'end_time',
    ];
}
