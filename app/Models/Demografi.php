<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demografi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kecamatan',
        'jumlah_penduduk',
        'luas_wilayah',
        'tahun',
    ];
}