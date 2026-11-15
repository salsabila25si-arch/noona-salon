<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StylistController extends Controller
{
    public function index()
    {
        $stylists = Stylist::latest()->get();
        return view('admin.stylist.index', compact('stylists'));
    }

    public function create()
    {
        return view('admin.stylist.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'spesialisasi' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('stylist', 'public');
        }

        Stylist::create($validated);

        return redirect()->route('admin.stylist.index')->with('success', 'Data stylist berhasil ditambahkan.');
    }

    public function edit(Stylist $stylist)
    {
        return view('admin.stylist.edit', compact('stylist'));
    }

    public function update(Request $request, Stylist $stylist)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'spesialisasi' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            if ($stylist->foto) {
                Storage::disk('public')->delete($stylist->foto);
            }
            $validated['foto'] = $request->file('foto')->store('stylist', 'public');
        }

        $stylist->update($validated);

        return redirect()->route('admin.stylist.index')->with('success', 'Data stylist berhasil diperbarui.');
    }

    public function destroy(Stylist $stylist)
    {
        if ($stylist->foto) {
            Storage::disk('public')->delete($stylist->foto);
        }

        $stylist->delete();

        return redirect()->route('admin.stylist.index')->with('success', 'Data stylist berhasil dihapus.');
    }
}