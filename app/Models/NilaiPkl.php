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

}
