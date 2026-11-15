<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $guarded = ['id'];

    public function layanans()
    {
        return $this->hasMany(Layanan::class, 'kategori_id');
    }

    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'kategori_id');
    }
}