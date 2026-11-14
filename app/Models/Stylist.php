<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    use HasFactory;

    protected $table = 'stylist';
    protected $fillable = ['nama', 'spesialisasi', 'foto'];

    public function layanan()
    {
        return $this->belongsToMany(Layanan::class, 'layanan_stylist', 'stylist_id', 'layanan_id');
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'stylist_id');
    }
}
