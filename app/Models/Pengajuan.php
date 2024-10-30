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
        'nama_dudi',
        'notelp_dudi',  // Foreign key ke tabel dudi
        'proposal_pkl',  // File proposal PKL
        'status_acc',
        'created_by',
        'approved_by'
    ];

    // Atur jika tidak menggunakan kolom timestamp (created_at, updated_at)
    public $timestamps = false;

    // Relasi dengan model siswa
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'pengajuan_siswa', 'id_pengajuan', 'nis');
    }

    public function dudi()
    {
        return $this->belongsTo(Dudi::class, 'nama_dudi', 'nama_dudi');
    }

//     public function dudi()
// {
//     return $this->belongsTo(Dudi::class, 'kode_dudi', 'kode_dudi'); // Menggunakan 'kode_dudi' sebagai foreign key
// }

    
    public function ploting()
    {
        return $this->hasMany(Ploting::class, 'nama_dudi', 'nama_dudi');
    }
    

    
}
