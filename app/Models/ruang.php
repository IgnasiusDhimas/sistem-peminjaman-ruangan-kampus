<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $fillable = ['gedung_id', 'nama', 'kapasitas'];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
