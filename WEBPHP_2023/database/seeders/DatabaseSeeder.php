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
            'password' => bcrypt("admin123"),
            'role' => 'superadmin'
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
    }
}
