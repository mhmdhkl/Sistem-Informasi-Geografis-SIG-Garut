<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statistiks')->insert([
            ['nama_data' => 'luas_wilayah', 'nilai_data' => '3,074.07 km²', 'sumber_data' => 'BPS Garut 2023', 'created_at' => now(), 'updated_at' => now()],
            ['nama_data' => 'jumlah_penduduk', 'nilai_data' => '2,756,831', 'sumber_data' => 'Disdukcapil 2024', 'created_at' => now(), 'updated_at' => now()],
            ['nama_data' => 'jumlah_kecamatan', 'nilai_data' => '42', 'sumber_data' => 'Pemerintah Kab. Garut', 'created_at' => now(), 'updated_at' => now()],
            ['nama_data' => 'jumlah_desa', 'nilai_data' => '421', 'sumber_data' => 'Pemerintah Kab. Garut', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}