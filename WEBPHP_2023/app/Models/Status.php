<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'description'
    ];
    
    public static function getStatusOptions()
    {
        return [
            'submitted' => 'submitted',
            'label printed' => 'label printed',
            'delivered to warehouse' => 'delivered to warehouse',
            'in sorting centre' => 'in sorting centre',
            'on its way' => 'on its way',
            'delivered to customer' => 'delivered to customer'
        ];
    }
}
