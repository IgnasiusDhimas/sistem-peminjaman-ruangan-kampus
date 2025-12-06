<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    // FIX NAMA TABEL
    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id', 'email_user','peminjam_nama','gedung_id', 'ruang_id',
        'tanggal', 'jam_mulai', 'jam_selesai',
        'status', 'keperluan', 'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }
}
