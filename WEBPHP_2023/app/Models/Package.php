<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'labelID',
        'pickupID',
        'trackandtracecode',
        'status',
        'width',
        'length',
        'height',
        'weight'
    ];
}
