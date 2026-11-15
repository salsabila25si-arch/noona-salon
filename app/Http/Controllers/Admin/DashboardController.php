<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Reservasi;
use App\Models\Stylist;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLayanan = Layanan::count();
        $totalStylist = Stylist::count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $reservasiMenunggu = Reservasi::where('status', 'Menunggu')->count();
        $reservasiHariIni = Reservasi::with(['layanan', 'stylist'])
            ->whereDate('tanggal', today())
            ->orderBy('jam_mulai')
            ->get();

        $totalPendapatan = Reservasi::where('reservasi.status', 'Selesai')
            ->join('layanan', 'reservasi.layanan_id', '=', 'layanan.id')
            ->sum('layanan.harga');

        return view('admin.dashboard', compact(
            'totalLayanan',
            'totalStylist',
            'totalPelanggan',
            'reservasiMenunggu',
            'reservasiHariIni',
            'totalPendapatan'
        ));
    }
}