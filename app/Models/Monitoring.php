<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'monitoring';

    // Primary key
    protected $primaryKey = 'id_monitoring';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'NIS',                     
        'kode_kelompok',           
        'nama_siswa',              
        'konsentrasi_keahlian',    
        'nama_dudi',               
        'kelas',                   
        'tahun'                    
    ];

    // Atur jika tidak menggunakan kolom timestamp (created_at, updated_at)
    public $timestamps = false;

    // Relasi ke model Siswa (untuk NIS)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }

    // Relasi ke model Kelompok
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kode_kelompok', 'kode_kelompok');
    }

    // Relasi ke model Siswa (untuk nama_siswa)
    public function siswaByNama()
    {
        return $this->belongsTo(Siswa::class, 'nama_siswa', 'nama_siswa');
    }

    // Relasi ke model Siswa (untuk konsentrasi_keahlian)
    public function konsentrasiKeahlian()
    {
        return $this->belongsTo(Siswa::class, 'konsentrasi_keahlian', 'kode_konsentrasi');
    }

    // Relasi ke model Dudi
    public function dudi()
    {
        return $this->belongsTo(Dudi::class, 'nama_dudi', 'nama_dudi');
    }

    // Relasi ke model Siswa (untuk kelas)
    public function siswaByKelas()
    {
        return $this->belongsTo(Siswa::class, 'kelas', 'kelas');
    }

    // Relasi ke model Siswa (untuk tahun)
    public function siswaByTahun()
    {
        return $this->belongsTo(Siswa::class, 'tahun', 'tahun');
    }
}
