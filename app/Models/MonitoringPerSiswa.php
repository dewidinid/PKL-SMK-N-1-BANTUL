<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringPerSiswa extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'monitoring_per_siswa';

    // Primary key
    protected $primaryKey = 'id_monitoring_persiswa';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'NIS',
        'nilai_tp1',
        'nilai_tp2',
        'nilai_tp3',
        'nilai_tp4',
        'nilai_monitoring',
        'nilai_akhir_monitoring',
    ];

    // Tidak menggunakan kolom timestamp
    public $timestamps = false;

    // Relasi ke model Siswa (untuk NIS)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }
}