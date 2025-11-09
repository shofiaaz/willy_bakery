<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'owner01',
                'email' => 'owner@example.com',
                'password' => Hash::make('owner123'),
                'role' => 'owner',
                'phone' => '081234567890',
                'created_at' => now(),
            ],
            [
                'username' => 'admin01',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '081111111111',
                'created_at' => now(),
            ],
            [
                'username' => 'staff01',
                'email' => 'staff@example.com',
                'password' => Hash::make('staff123'),
                'role' => 'staff',
                'phone' => '082222222222',
                'created_at' => now(),
            ],
        ]);
    }
}
