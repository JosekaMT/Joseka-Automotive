<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'address' => 'C/Andres Almonaster y Roxas 1',
            'is_admin' => true,
            'city' => 'Sevilla',          
            'phone_number' => '+34 677 27 57 27', 
        ]);
    }
}
