<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\Reservasi;
use App\Models\Stylist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NoonaSalonSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin & Pelanggan
        User::create([
            'nama' => 'Admin Noona',
            'email' => 'admin@noona.example',
            'no_hp' => '081200000001',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $pelanggan = User::create([
            'nama' => 'Alya Putri',
            'email' => 'alya@contoh.id',
            'no_hp' => '081234567890',
            'password' => Hash::make('password123'),
            'role' => 'pelanggan',
        ]);

        // 2. Kategori Layanan
        $katPotong = Kategori::create(['nama' => 'Potong']);
        $katPerawatan = Kategori::create(['nama' => 'Perawatan']);
        $katPewarnaan = Kategori::create(['nama' => 'Pewarnaan']);

        // 3. Data 6 Layanan
        $l1 = Layanan::create([
            'kategori_id' => $katPotong->id,
            'nama' => 'Potong Rambut',
            'deskripsi' => 'Potongan baru yang paling kamu banget.',
            'harga' => 60000,
            'durasi_menit' => 45,
        ]);

        $l2 = Layanan::create([
            'kategori_id' => $katPerawatan->id,
            'nama' => 'Creambath',
            'deskripsi' => 'Nutrisi rambut, rileks sampai ke kepala.',
            'harga' => 90000,
            'durasi_menit' => 60,
        ]);

        $l3 = Layanan::create([
            'kategori_id' => $katPewarnaan->id,
            'nama' => 'Hair Coloring',
            'deskripsi' => 'Warna pilihan untuk cerita barumu.',
            'harga' => 250000,
            'durasi_menit' => 120,
        ]);

        $l4 = Layanan::create([
            'kategori_id' => $katPerawatan->id,
            'nama' => 'Smoothing',
            'deskripsi' => 'Rambut halus, lembut, dan mudah diatur.',
            'harga' => 350000,
            'durasi_menit' => 150,
        ]);

        $l5 = Layanan::create([
            'kategori_id' => $katPerawatan->id,
            'nama' => 'Hair Spa',
            'deskripsi' => 'Perawatan intensif untuk kilau alaminya.',
            'harga' => 120000,
            'durasi_menit' => 60,
        ]);

        $l6 = Layanan::create([
            'kategori_id' => $katPotong->id,
            'nama' => 'Styling',
            'deskripsi' => 'Tampil istimewa di setiap momenmu.',
            'harga' => 75000,
            'durasi_menit' => 30,
        ]);

        // 4. Data Stylist & Relasi Many-to-Many
        $naya = Stylist::create([
            'nama' => 'Naya Putri',
            'spesialisasi' => 'Potong rambut & perawatan rambut',
        ]);
        $naya->layanan()->attach([$l1->id, $l2->id, $l5->id]);

        $mira = Stylist::create([
            'nama' => 'Mira Kusuma',
            'spesialisasi' => 'Creambath & Hair Spa',
        ]);
        $mira->layanan()->attach([$l2->id, $l4->id, $l5->id]);

        $sera = Stylist::create([
            'nama' => 'Sera Wijaya',
            'spesialisasi' => 'Hair Coloring & Smoothing',
        ]);
        $sera->layanan()->attach([$l3->id, $l4->id]);

        $luna = Stylist::create([
            'nama' => 'Luna Pratama',
            'spesialisasi' => 'Potong & Styling',
        ]);
        $luna->layanan()->attach([$l1->id, $l6->id]);

        // 5. Data Contoh Reservasi
        Reservasi::create([
            'kode' => 'RSV-001',
            'layanan_id' => $l1->id,
            'stylist_id' => $naya->id,
            'user_id' => $pelanggan->id,
            'nama_pelanggan' => 'Alya Putri',
            'no_hp' => '081234567890',
            'tanggal' => '2026-11-12',
            'jam_mulai' => '09:00:00',
            'jam_selesai' => '09:45:00',
            'status' => 'Menunggu',
            'catatan' => 'Ingin potongan sebahu, tetap mudah diatur.',
        ]);

        Reservasi::create([
            'kode' => 'RSV-002',
            'layanan_id' => $l2->id,
            'stylist_id' => $mira->id,
            'user_id' => null,
            'nama_pelanggan' => 'Dinda Sari',
            'no_hp' => '081298765432',
            'tanggal' => '2026-11-12',
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '11:00:00',
            'status' => 'Dikonfirmasi',
            'catatan' => null,
        ]);
    }
}