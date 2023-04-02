<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'review_text',
        'amount_of_stars',
        'packageID',
        'delivery_service',
        'date_of_review',
        'webshopName',
    ];
}
