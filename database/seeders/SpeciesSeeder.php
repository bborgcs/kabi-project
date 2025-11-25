<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "common_name" => "Sabiá-laranjeira", "scientific_name" => "Turdus rufiventris", "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "common_name" => "Bem-te-vi", "scientific_name" => "Pitangus sulphuratus", "created_at" => now(),
                "updated_at" => now(),
            ],
        ];

        DB::table('species')->insert($data);
    }
}
