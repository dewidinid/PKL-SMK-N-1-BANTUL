<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kelompok';

    // Primary key
    protected $primaryKey = 'kode_kelompok';

    // Menetapkan apakah kolom timestamp (created_at, updated_at) digunakan
    public $timestamps = false;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_kelompok',
    ];

    // Jika ada relasi dengan tabel lain, tambahkan di sini
    // Contoh relasi (jika ada):
    // public function siswa()
    // {
    //     return $this->hasMany(Siswa::class, 'kode_kelompok', 'kode_kelompok');
    // }
}
