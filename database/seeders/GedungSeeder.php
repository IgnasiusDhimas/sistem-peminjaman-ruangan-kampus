<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GedungSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gedungs')->insert([
            [
                'nama' => 'Gedung A',
                'deskripsi' => 'Gedung perkuliahan utama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gedung B',
                'deskripsi' => 'Gedung laboratorium komputer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gedung C',
                'deskripsi' => 'Gedung organisasi mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
