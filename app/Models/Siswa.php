<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';  // Nama tabel di database

    protected $primaryKey = 'NIS'; // Primary key tabel

    public $incrementing = false;  // Karena NIS bukan auto-increment

    protected $fillable = [
        'NIS',
        'nama_siswa',
        'konsentrasi_keahlian',
        'password',
        'kelas',
        'tahun',
        'kode_kelompok',
        'kode_dudi',
        'nama_dudi',
        'alamat_dudi',
    ];

    // Relationship to konsentrasi_keahlian
    public function konsentrasiKeahlian()
    {
        return $this->belongsTo(KonsentrasiKeahlian::class, 'konsentrasi_keahlian', 'kode_konsentrasi');
    }

    // Relationship to kelompok
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kode_kelompok', 'kode_kelompok');
    }

    // Relationship to dudi
    public function dudi()
    {
        return $this->belongsTo(Dudi::class, 'kode_dudi', 'kode_dudi');
    }
}
