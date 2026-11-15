<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::with('kategori')->latest()->get();
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.layanan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategori,id'],
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'harga' => ['required', 'integer', 'min:0'],
            'durasi_menit' => ['required', 'integer', 'min:5'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('layanan', 'public');
        }

        Layanan::create($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        $kategoris = Kategori::all();
        return view('admin.layanan.edit', compact('layanan', 'kategoris'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategori,id'],
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'harga' => ['required', 'integer', 'min:0'],
            'durasi_menit' => ['required', 'integer', 'min:5'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            if ($layanan->foto) {
                Storage::disk('public')->delete($layanan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('layanan', 'public');
        }

        $layanan->update($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->foto) {
            Storage::disk('public')->delete($layanan->foto);
        }

        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}