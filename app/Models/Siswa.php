<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Ganti ini
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Authenticatable // Ganti dari Model menjadi Authenticatable
{
    use HasFactory;

    protected $table = 'siswa';  // Nama tabel di database

    protected $primaryKey = 'NIS'; // Primary key tabel

    protected $guarded = [];
    protected $hidden = ['password'];

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

    // Menambahkan event model untuk mengatur password default saat siswa baru dibuat
    protected static function booted()
    {
        static::creating(function ($siswa) {
            // Mengatur password default menjadi pw[NIS]
            $siswa->password = bcrypt('pw' . $siswa->NIS);
        });
    }

    public function ploting()
    {
        return $this->hasOne(Ploting::class, 'NIS', 'NIS');
    }

    // Accessor untuk mendapatkan kode_kelompok dari tabel ploting
    public function getKodeKelompokAttribute()
    {
        return $this->ploting ? $this->ploting->kode_kelompok : null;
    }

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

    // Relasi dengan Monitoring
    public function monitoring()
    {
        return $this->hasMany(Monitoring::class, 'NIS', 'NIS');
    }

    public function laporanPengimbasan()
    {
        return $this->hasMany(LaporanPengimbasan::class, 'nis', 'NIS'); // Sesuaikan dengan kolom yang tepat
    }

    public function laporanAkhir()
    {
        return $this->hasMany(LaporanAkhir::class, 'nis', 'NIS'); // Sesuaikan dengan kolom yang tepat
    }

    public function pengajuan()
    {
        return $this->belongsToMany(Pengajuan::class, 'pengajuan_siswa', 'nis', 'id_pengajuan');
    }


}
