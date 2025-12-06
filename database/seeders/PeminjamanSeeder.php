<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        $user = \App\Models\User::find(2); // pastikan user_id 2 memang ada

        DB::table('peminjamans')->insert([
            [
                'user_id' => 2, // mahasiswa
                'email_user'=>$user->email,
                'gedung_id' => 1,
                'ruang_id' => 1,
                'tanggal' => '2025-12-01',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00',
                'status' => 'pending',
                'keperluan' => 'Belajar kelompok',
                'catatan' => 'Butuh proyektor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
