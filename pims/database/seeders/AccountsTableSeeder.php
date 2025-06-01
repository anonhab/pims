<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('accounts')->insert([
            [
                'user_id' => 1,
                'username' => 'centraladmin',
               'password' => Hash::make('password123'),
                'role_id' => 2,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'centraladmin@example.com',
                'user_image' => 'profile1.jpg',
                'phone_number' => '1234567890',
                'dob' => '1990-01-01',
                'gender' => 'male',
                'address' => 'central ethiopia, City',
                'created_at' => now(),
                'updated_at' => now(),
                'prison_id' => 1,
            ]
            
        ]);
    }
}
