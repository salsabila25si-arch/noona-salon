<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Reservasi;
use App\Models\Stylist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReservasiController extends Controller
{
    public function create(Request $request)
    {
        $layanans = Layanan::with('kategori')->get();
        $stylists = Stylist::all();
        $selectedLayananId = $request->query('layanan_id');

        return view('reservasi.create', compact('layanans', 'stylists', 'selectedLayananId'));
    }

public function store(Request $request)
    {
        $validated = $request->validate([
            'layanan_id' => ['required', 'exists:layanan,id'],
            'stylist_id' => ['nullable', 'exists:stylist,id'],
            'nama_pelanggan' => ['nullable', 'string', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'jam_mulai' => ['required'],
            'catatan' => ['nullable', 'string'],
        ]);

        $user = Auth::user();
        $layanan = Layanan::findOrFail($validated['layanan_id']);
        $jamSelesai = Carbon::parse($validated['jam_mulai'])
            ->addMinutes($layanan->durasi_menit ?? 60)
            ->format('H:i');

        $kode = 'NS-' . strtoupper(Str::random(6));

        $reservasi = Reservasi::create([
            'kode' => $kode,
            'user_id' => $user?->id,
            'layanan_id' => $validated['layanan_id'],
            'stylist_id' => $validated['stylist_id'] ?? null,
            'nama_pelanggan' => $request->input('nama_pelanggan') ?? $request->input('nama_pemesan') ?? $request->input('nama') ?? $user?->name ?? 'Pelanggan',
            'no_hp' => $request->input('no_hp') ?? $request->input('telepon') ?? $user?->no_hp ?? '-',
            'tanggal' => $validated['tanggal'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $jamSelesai,
            'catatan' => $validated['catatan'] ?? null,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('reservasi.show', $reservasi->kode)
            ->with('success', 'Reservasi berhasil dibuat!');
    }

   public function cek(Request $request)
{
    $reservasi = null;

    if ($request->filled('kode')) {
        $kode = strtoupper(trim($request->query('kode')));
        $reservasi = Reservasi::with(['layanan', 'stylist'])
            ->where('kode', $kode)
            ->first();
    }

    return view('reservasi.cek', compact('reservasi'));
}

    public function show($kode)
    {
        $reservasi = Reservasi::with(['layanan', 'stylist'])
            ->where('kode', $kode)
            ->firstOrFail();

        return view('reservasi.show', compact('reservasi'));
    }

    public function riwayat()
    {
        $reservasis = Reservasi::with(['layanan', 'stylist'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('reservasi.riwayat', compact('reservasis'));
    }

    public function batal($kode)
    {
        $reservasi = Reservasi::where('kode', $kode)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($reservasi->status === 'Menunggu') {
            $reservasi->update(['status' => 'Batal']);
            return back()->with('success', 'Reservasi berhasil dibatalkan.');
        }

        return back()->with('error', 'Reservasi tidak dapat dibatalkan.');
    }
}
