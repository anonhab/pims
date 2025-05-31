<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('accounts')->insert([
            [
                'id' => 1,
                'email' => 'central@gmail.com',
                'password' => '$2y$12$cOF4CjekXagW.ukYjXb.6urD3zD6efSt/9bugfgUHsWOoP.4rWdQC',
                'role_id' => 1,
                'first_name' => 'Habtamu',
                'last_name' => 'Gashu',
                'alternate_email' => 'Habtsha2021zz@gmail.com',
                'profile_image' => 'user_images/8C2VnRFEJWwNVtKYQQs9I7IS4wH0Ko1oPCpbdJs9.png',
                'phone' => '0909029295',
                'dob' => '2025-03-15',
                'gender' => 'male',
                'address' => 'Addis Ababa, Bole',
                'created_at' => '2025-03-30 22:57:39',
                'updated_at' => '2025-03-30 22:57:39',
                'age' => 18,
            ]
        ]);
    }
}
