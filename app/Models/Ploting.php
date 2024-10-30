<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ploting extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'ploting';

    // Primary key
    protected $primaryKey = 'id_ploting';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_kelompok',   // Foreign key ke tabel kelompok
        'NIP_NIK',
        'kode_dudi',
        'nama_pembimbing', // Foreign key ke tabel pembimbing
        'nama_dudi',       // Foreign key ke tabel dudi
        'NIS',             // Foreign key ke tabel siswa
        'kelas',           // Foreign key ke tabel siswa
        'notelp_dudi'      // Foreign key ke tabel dudi
    ];

    // Atur jika tidak menggunakan kolom timestamp (created_at, updated_at)
    public $timestamps = false;

    // Relasi ke model Kelompok
    // public function kelompok()
    // {
    //     return $this->belongsTo(Kelompok::class, 'kode_kelompok', 'kode_kelompok');
    // }

    // Relasi ke model Pembimbing
    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'nama_pembimbing', 'nama_pembimbing');
    }

    //Relasi ke model Dudi
    public function dudi()
    {
        return $this->belongsTo(Dudi::class, 'nama_dudi', 'nama_dudi');
    }

//     public function dudi()
// {
//     return $this->belongsTo(Dudi::class, 'kode_dudi', 'kode_dudi');
// }


    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }

    public function nilaiPkl()
    {
        return $this->hasOne(NilaiPkl::class, 'NIS', 'NIS');
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'nama_dudi', 'nama_dudi');
    }
}
