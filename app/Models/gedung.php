<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $fillable = ['nama', 'deskripsi'];

    public function ruangs()
    {
        return $this->hasMany(Ruang::class);
    }
}
