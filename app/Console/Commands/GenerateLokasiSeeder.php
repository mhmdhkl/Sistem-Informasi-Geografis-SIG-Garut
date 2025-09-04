<?php

namespace App\Console\Commands;

use App\Models\Lokasi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateLokasiSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:generate-lokasi-seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a seeder file for the lokasis table from existing data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 1. Ambil semua data dari tabel 'lokasis' melalui model Lokasi
        //    Gunakan ->makeHidden(['id']) untuk menyembunyikan kolom 'id'
        //    karena ID biasanya auto-increment dan tidak perlu di-seed.
        $lokasis = Lokasi::all()->makeHidden(['id'])->toArray();

        if (empty($lokasis)) {
            $this->info('The lokasis table is empty. No seeder file was generated.');
            return;
        }

        // 2. Ubah data array menjadi string format PHP yang rapi
        $dataAsString = var_export($lokasis, true);

        // 3. Buat template untuk file seeder
        $seederFileContent = <<<PHP
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate (kosongkan) tabel sebelum seeding agar data tidak duplikat
        DB::table('lokasis')->truncate();
        
        DB::table('lokasis')->insert({$dataAsString});
    }
}
PHP;

        // 4. Tentukan path untuk menyimpan file seeder
        $path = database_path('seeders/LokasiSeeder.php');

        // 5. Tulis konten ke dalam file
        File::put($path, $seederFileContent);

        // 6. Tampilkan pesan sukses di terminal
        $this->info('LokasiSeeder.php has been generated successfully!');
    }
}