<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'System Administrator', 'description' => 'gugui', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Inspector', 'description' => 'hhh', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Central Administrator', 'description' => 'this central admin controls overall system', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Visitor', 'description' => 'lol am i visitor', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Commissioner', 'description' => 'zz', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Training Officer', 'description' => 'sfasf', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'Police Officer', 'description' => 'Police officer role', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'name' => 'Medical Officer', 'description' => 'Medical officer for prisons', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'name' => 'Security Officer', 'description' => 'security for prisons', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'name' => 'Discipline Officer', 'description' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
