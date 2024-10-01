<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPkl extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'nilai_pkl';

    // Primary key
    protected $primaryKey = 'id_nilai';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_kelompok',            
        'NIS',                      
        'nama',                         
        'konsentrasi_keahlian',                 
        'kelas',                        
        'tahun',                    
        'nilai',
        'file_path'                   
    ];

    // Atur jika tidak menggunakan kolom timestamp (created_at, updated_at)
    public $timestamps = false;

    // Relasi ke model Kelompok
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kode_kelompok', 'kode_kelompok');
    }

    // Relasi ke model Siswa (untuk NIS)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }

    // Relasi ke model Siswa (untuk nama)
    public function siswaByNama()
    {
        return $this->belongsTo(Siswa::class, 'nama', 'nama_siswa');
    }

    // Relasi ke model Siswa (untuk konsentrasi_keahlian)
    public function konsentrasiKeahlian()
    {
        return $this->belongsTo(Siswa::class, 'konsentrasi_keahlian', 'kode_konsentrasi');
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
