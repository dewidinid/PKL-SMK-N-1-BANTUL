<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPengimbasan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'laporan_pengimbasan';

    // Primary key
    protected $primaryKey = 'id_pengimbasan';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_kelompok',  
        'kode_dudi',          
        'NIS',                      
        'konsentrasi_keahlian',     
        'nama',                     
        'kelas',                    
        'nama_dudi',                
        'laporan_pengimbasan',
        'approved_lap_pengimbasan'       
    ];

    // Atur jika tidak menggunakan kolom timestamp (created_at, updated_at)
    public $timestamps = false;

    // Relasi ke model Siswa (untuk NIS)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }

    // Relasi ke model Siswa (untuk konsentrasi_keahlian)
    public function konsentrasiKeahlian()
    {
        return $this->belongsTo(Siswa::class, 'konsentrasi_keahlian', 'kode_konsentrasi');
    }

    // Relasi ke model Siswa (untuk nama)
    public function siswaByNama()
    {
        return $this->belongsTo(Siswa::class, 'nama', 'nama_siswa');
    }

    // Relasi ke model Siswa (untuk kelas)
    public function siswaByKelas()
    {
        return $this->belongsTo(Siswa::class, 'kelas', 'kelas');
    }

    // Relasi ke model Dudi
    public function dudi()
    {
        return $this->belongsTo(Dudi::class, 'nama_dudi', 'kode_dudi');
    }
}