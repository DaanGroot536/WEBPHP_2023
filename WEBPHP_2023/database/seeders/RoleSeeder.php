<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'type' => 'superadmin'
         ]);
         Role::create([
             'type' => 'employee'
         ]);
         Role::create([
             'type' => 'customer'
         ]);
         Role::create([
             'type' => 'deliverer'
         ]);
         Role::create([
             'type' => 'webshop'
         ]);
         Role::create([
             'type' => 'packer'
         ]);
    }
}
