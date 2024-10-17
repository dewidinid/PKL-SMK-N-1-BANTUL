<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanJurnal extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'laporan_jurnal';

    // Primary key
    protected $primaryKey = 'id_jurnal';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'tanggal', 
        'NIS',          
        'nama_siswa',
        'konsentrasi_keahlian',
        'kelompok',
        'kelas',   
        'nama_dudi',   
        'kegiatan',     
        'lokasi'        
    ];

    // Atur jika tidak menggunakan kolom timestamp (created_at, updated_at)
    // public $timestamps = false;

    // Relasi ke model Siswa (untuk NIS)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }

    // Relasi ke model Siswa (untuk nama_siswa)
    public function siswaByNama()
    {
        return $this->belongsTo(Siswa::class, 'nama_siswa', 'nama_siswa');
    }

    // Relasi ke model Dudi
    public function dudi()
    {
        return $this->belongsTo(Dudi::class, 'nama_dudi', 'nama_dudi');
    }
}
