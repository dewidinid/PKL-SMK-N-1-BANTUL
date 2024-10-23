<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSiswa extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pengajuan_siswa';

    // Primary Key ganda (id_pengajuan dan nis)
    protected $primaryKey = ['id_pengajuan', 'nis'];

    // Karena primary key tidak auto-increment
    public $incrementing = false;

    // Jika timestamps (created_at, updated_at) digunakan
    public $timestamps = true;

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'id_pengajuan',
        'nis',
        'created_at',
        'updated_at',
    ];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'NIS');
    }

    // Relasi ke model Pengajuan
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan', 'id_pengajuan');
    }
}
