<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lokasis')->insert([
            [
                'nama_lokasi' => 'Candi Cangkuang',
                'kategori' => 'Budaya',
                'deskripsi' => 'Candi Hindu yang terletak di Kampung Pulo, Kecamatan Leles, Garut. Merupakan satu-satunya candi Hindu yang ditemukan di tatar Sunda.',
                'alamat' => 'Kampung Pulo, Cangkuang, Leles, Garut',
                'latitude' => -7.1023129,
                'longitude' => 107.9200045,
                'foto' => 'candi_cangkuang.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Pantai Santolo',
                'kategori' => 'Pariwisata',
                'deskripsi' => 'Salah satu pantai paling populer di Garut dengan pasir putih dan pemandangan laut yang indah.',
                'alamat' => 'Kecamatan Cikelet, Garut Selatan',
                'latitude' => -7.659938,
                'longitude' => 107.691913,
                'foto' => 'pantai_santolo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Kawah Talaga Bodas',
                'kategori' => 'Pariwisata',
                'deskripsi' => 'Kawah vulkanik dengan danau berwarna putih kehijauan yang menawan, dikelilingi oleh perbukitan hijau.',
                'alamat' => 'Kecamatan Wanaraja, Garut',
                'latitude' => -7.2120,
                'longitude' => 108.0672,
                'foto' => 'talaga_bodas.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}