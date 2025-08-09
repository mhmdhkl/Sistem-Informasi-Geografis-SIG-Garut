<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('beritas')->insert([
            [
                'judul' => 'Pemkab Garut Resmikan Desa Wisata Baru di Kecamatan Pasirwangi',
                'slug' => Str::slug('Pemkab Garut Resmikan Desa Wisata Baru di Kecamatan Pasirwangi'),
                'kutipan_singkat' => 'Pemerintah Kabupaten Garut meresmikan desa wisata baru yang diharapkan dapat meningkatkan perekonomian lokal dan menarik lebih banyak wisatawan.',
                'isi_berita' => 'Isi berita lengkap mengenai peresmian desa wisata baru...',
                'gambar' => 'berita-1.jpg',
                'sumber_url' => 'https://www.garutkab.go.id/berita',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Festival Budaya Garut Kembali Digelar Setelah Vakum Dua Tahun',
                'slug' => Str::slug('Festival Budaya Garut Kembali Digelar Setelah Vakum Dua Tahun'),
                'kutipan_singkat' => 'Antusiasme masyarakat sangat tinggi dalam menyambut kembali Festival Budaya Garut yang menampilkan berbagai kesenian tradisional.',
                'isi_berita' => 'Isi berita lengkap mengenai festival budaya...',
                'gambar' => 'berita-2.jpg',
                'sumber_url' => 'https://www.garutkab.go.id/berita',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}