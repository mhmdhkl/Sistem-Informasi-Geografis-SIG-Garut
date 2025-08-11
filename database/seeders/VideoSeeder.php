<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videos')->truncate();
        DB::table('videos')->insert([
            // === KONTEN VIDEO PARIWISATA ===
            [
                'judul' => 'Situ Bagendit Wisata Kelas Dunia dari Garut',
                'youtube_id' => 'sjG2LwZmDTI',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'judul' => 'Wisata Candi Cangkuang',
                'youtube_id' => 'j2B6jLFyAtw',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'judul' => 'Pantai Sayangheulang',
                'youtube_id' => 'a9-o5TCpX5c',
                'created_at' => now(), 'updated_at' => now()
            ],

            // === KONTEN VIDEO BUDAYA ===
            [
                'judul' => 'Gebyar Pesona Budaya Garut dan Garut Creative Fair',
                'youtube_id' => 'sIRF5BKVbBo',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'judul' => 'Rayuan Pulau Kelapa',
                'youtube_id' => 'AEop_fijPf8',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'judul' => 'Corak Batik Garutan',
                'youtube_id' => 'REhaWtk5D0I',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}