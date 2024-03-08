<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@localhost.com',
            'password' => Hash::make('admin123123')
        ]);

        $admin->assignRole('admin');

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@localhost.com',
            'password' => Hash::make('admin123123')
        ]);

        $superAdmin->assignRole('superadmin');
    }
}
