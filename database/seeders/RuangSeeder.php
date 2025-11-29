<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ruangs')->insert([
            // GEDUNG A
            [
                'gedung_id' => 1,
                'nama' => 'Ruang 101',
                'kapasitas' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gedung_id' => 1,
                'nama' => 'Ruang 102',
                'kapasitas' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // GEDUNG B
            [
                'gedung_id' => 2,
                'nama' => 'Lab Komputer 1',
                'kapasitas' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gedung_id' => 2,
                'nama' => 'Lab Komputer 2',
                'kapasitas' => 32,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // GEDUNG C
            [
                'gedung_id' => 3,
                'nama' => 'Ruang Rapat ORMAWA',
                'kapasitas' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
