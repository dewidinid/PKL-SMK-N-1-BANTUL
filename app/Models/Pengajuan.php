<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pengajuan';

    // Primary key
    protected $primaryKey = 'id_pengajuan';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nis',          // Foreign key ke tabel siswa
        'nama_siswa',
        'no_telp',      // Nomor telepon ketua
        'tempat_pkl',
        'notelp_dudi',  // Foreign key ke tabel dudi
        'proposal_pkl'  // File proposal PKL
    ];

    // Atur jika tidak menggunakan kolom timestamp (created_at, updated_at)
    public $timestamps = false;

    // Relasi dengan model siswa
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'pengajuan_siswa', 'id_pengajuan', 'nis');
    }

    // Relasi dengan model dudi
    public function dudi()
    {
        return $this->belongsTo(Dudi::class, 'notelp_dudi', 'notelp_dudi');
    }
}
