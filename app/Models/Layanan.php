<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    protected $fillable = [
        'kategori_id',
        'nama',
        'deskripsi',
        'harga',
        'durasi_menit',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function stylist()
    {
        return $this->belongsToMany(Stylist::class, 'layanan_stylist', 'layanan_id', 'stylist_id');
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'layanan_id');
    }

    public function scopeFilter(Builder $query, $request, array $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch(Builder $query, $request, array $searchableColumns)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'like', "%{$search}%");
                }
            });
        }
        return $query;
    }
}