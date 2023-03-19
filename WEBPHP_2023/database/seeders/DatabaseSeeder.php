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
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            StatusSeeder::class,
            PackageSeeder::class,
        ]);
    }
}
