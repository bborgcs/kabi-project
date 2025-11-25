<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "Gil Eduardo", "email" => "admin@example.com", "password" => Hash::make("123456"),
                "created_at" => now(), "updated_at" => now()
            ],
            [
                "name" => "Usuário Teste", "email" => "user@example.com", "password" => Hash::make("123456"),
                "created_at" => now(), "updated_at" => now()
            ],
        ];

        DB::table('users')->insert($data);
    }
}
