<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
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
            'name' => 'employee',
            'email' => 'emp@emp.com',
            'password' => bcrypt("password"),
            'role' => 'employee',
            'api_token' => Str::random(60),
        ]);

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

        Status::create([
           'description' => 'Submitted'
        ]);
        Status::create([
            'description' => 'label printed'
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
            'description' => 'Delivered'
        ]);
    }
}
