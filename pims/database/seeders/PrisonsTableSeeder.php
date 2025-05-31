<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrisonsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('prisons')->insert([
            ['id' => 1, 'name' => 'wolkite prison', 'location' => 'Bahir Dar', 'phone' => '2121212', 'created_at' => '2025-03-09 04:41:27', 'updated_at' => '2025-05-17 02:06:37'],
            ['id' => 2, 'name' => 'gurage prison', 'location' => 'gurage', 'phone' => '2312312', 'created_at' => '2025-03-09 04:51:07', 'updated_at' => '2025-03-09 04:51:07'],
        ]);
    }
}
