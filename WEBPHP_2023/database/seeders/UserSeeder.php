<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt("password"),
            'role' => 'superadmin',
            'street' => 'yes',
            'housenumber' => 1,
            'zipcode' => '5555hl',
            'city' => 'monketown',
            'api_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'webshop',
            'email' => 'web@web.com',
            'password' => bcrypt("password"),
            'role' => 'webshop',
            'street' => 'yes',
            'housenumber' => 1,
            'zipcode' => '5555hl',
            'city' => 'monketown',
            'api_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'customer',
            'email' => 'cust@cust.com',
            'password' => bcrypt("password"),
            'role' => 'customer',
            'street' => 'yes',
            'housenumber' => 1,
            'zipcode' => '5555hl',
            'city' => 'monketown',
            'api_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'deliverer',
            'email' => 'del@del.com',
            'password' => bcrypt("password"),
            'role' => 'deliverer',
            'street' => 'yes',
            'housenumber' => 1,
            'zipcode' => '5555hl',
            'city' => 'monketown',
            'api_token' => Str::random(60),
            'company' => 'DHL',
        ]);
        User::create([
            'name' => 'employee',
            'email' => 'emp@emp.com',
            'password' => bcrypt("password"),
            'role' => 'employee',
            'api_token' => Str::random(60),
        ]);
    }
}
