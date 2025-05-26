<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan role terlebih dahulu
        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        $userRole = Role::create([
            'name' => 'user',
        ]);

        // Tambahkan pengguna dengan role admin
        User::create([
            'userid' => 'admin',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id // Hubungkan dengan role admin
        ]);

        // Tambahkan pengguna dengan role user
        User::create([
            'userid' => 'user',
            'password' => Hash::make('password123'),
            'role_id' => $userRole->id // Hubungkan dengan role user
        ]);
    }
}
