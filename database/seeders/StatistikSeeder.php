<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Statistik; // Pastikan Anda menggunakan model Statistik

class StatistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama_data' => 'luas_wilayah',
                'nilai_data' => '3,074.07 km²',
                'sumber_data' => 'BPS Garut 2023'
            ],
            [
                'nama_data' => 'jumlah_penduduk',
                'nilai_data' => '2756831', // Simpan sebagai angka agar mudah diolah
                'sumber_data' => 'Disdukcapil 2024'
            ],
            [
                'nama_data' => 'jumlah_kecamatan',
                'nilai_data' => '42',
                'sumber_data' => 'Pemerintah Kab. Garut'
            ],
            [
                'nama_data' => 'jumlah_desa',
                'nilai_data' => '421',
                'sumber_data' => 'Pemerintah Kab. Garut'
            ],
        ];

        // Looping setiap data dan gunakan updateOrCreate
        foreach ($data as $item) {
            Statistik::updateOrCreate(
                ['nama_data' => $item['nama_data']], // Kunci untuk mencari data
                $item // Data untuk diperbarui atau dibuat
            );
        }
    }
}