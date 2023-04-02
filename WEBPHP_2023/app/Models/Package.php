<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Package extends Model
{
    use Searchable;
    use HasFactory;

    protected $fillable = [
        'id',
        'labelID',
        'pickupID',
        'trackandtracecode',
        'status',
        'dimensions',
        'weight',
        'webshopName',
        'webshopStreet',
        'webshopHousenumber',
        'webshopZipcode',
        'webshopCity',
        'customerEmail',
        'customerName',
        'customerStreet',
        'customerHousenumber',
        'customerZipcode',
        'customerCity',
    ];

    public function getFullCustomerAddressAttribute()
    {
        return "{$this->customerStreet} {$this->customerHousenumber}, {$this->customerZipcode} {$this->customerCity}";
    }

    public function getFullWebshopAddressAttribute()
    {
        return "{$this->webshopStreet} {$this->webshopHousenumber}, {$this->webshopZipcode} {$this->webshopCity}";
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return array('status' => $array['status'],'webshopName' => $array['webshopName'],'customerEmail' => $array['customerEmail'],'customerName' => $array['customerName'], 'customerCity' => $array['customerCity'], 'customerZipcode' => $array['customerZipcode'],  'customerStreet' => $array['customerStreet']);
    }
}
