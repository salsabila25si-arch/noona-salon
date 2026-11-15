<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservasi::with(['layanan', 'stylist', 'user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $reservasis = $query->latest('tanggal')->latest('jam_mulai')->get();

        return view('admin.reservasi.index', compact('reservasis'));
    }

    public function updateStatus(Request $request, Reservasi $reservasi)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Menunggu,Dikonfirmasi,Selesai,Batal'],
        ]);

        $reservasi->update(['status' => $validated['status']]);

        return back()->with('success', "Status reservasi {$reservasi->kode} berhasil diubah menjadi {$validated['status']}.");
    }

    public function destroy(Reservasi $reservasi)
    {
        $reservasi->delete();

        return back()->with('success', 'Data reservasi berhasil dihapus.');
    }
}