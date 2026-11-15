<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\Stylist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::with('layanans')->get();
        $layanans = Layanan::with('kategori')->latest()->get();
        $stylists = Stylist::all();
        $galeris = Galeri::latest()->take(8)->get();

        return view('home', compact('kategoris', 'layanans', 'stylists', 'galeris'));
    }

    public function layanan(Request $request)
    {
        $kategoris = Kategori::all();
        $query = Layanan::with('kategori');

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $layanans = $query->get();

        return view('layanan.index', compact('kategoris', 'layanans'));
    }

    public function galeri()
    {
        $galeris = Galeri::latest()->get();

        return view('galeri.index', compact('galeris'));
    }
}