<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'city' => 'monketown'
        ]);
//        User::create([
//            'name' => 'webshop',
//            'email' => 'web@web.com',
//            'password' => bcrypt("password"),
//            'role' => 'webshop'
//        ]);
//        User::create([
//            'name' => 'employee',
//            'email' => 'emp@emp.com',
//            'password' => bcrypt("password"),
//            'role' => 'employee'
//        ]);

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
