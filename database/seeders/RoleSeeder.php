<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["name" => "ADMINISTRADOR", "created_at" => now(), "updated_at" => now()],    // 1
            ["name" => "USUÁRIO",  "created_at" => now(), "updated_at" => now()],  // 2
        ];
        DB::table('roles')->insert($data);
    }
}