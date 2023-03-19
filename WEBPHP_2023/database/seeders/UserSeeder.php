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
            'name' => 'Sport World',
            'email' => 'sport@world.com',
            'password' => bcrypt("password"),
            'role' => 'webshop',
            'street' => 'Marie Heinekenplein',
            'housenumber' => 5,
            'zipcode' => '4551VK',
            'city' => 'Rotterdam',
            'api_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'Books Galore',
            'email' => 'books@galore.com',
            'password' => bcrypt("password"),
            'role' => 'webshop',
            'street' => 'Lange Poten',
            'housenumber' => 11,
            'zipcode' => '7994CS',
            'city' => 'Groningen',
            'api_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'Electroshop',
            'email' => 'electro@shop.com',
            'password' => bcrypt("password"),
            'role' => 'webshop',
            'street' => 'Keizersgracht',
            'housenumber' => 10,
            'zipcode' => '3842LM',
            'city' => 'Amsterdam',
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
