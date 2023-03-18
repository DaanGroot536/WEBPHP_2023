<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        Status::create([
            'description' => 'Submitted'
         ]);
         Status::create([
             'description' => 'Label printed'
         ]);
         Status::create([
             'description' => 'Delivered to warehouse'
         ]);
         Status::create([
             'description' => 'In sorting centre'
         ]);
         Status::create([
             'description' => 'On its way'
         ]);
         Status::create([
             'description' => 'Delivered to customer'
         ]);
    }
}
