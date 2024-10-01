<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'dudi';

    // Primary key
    protected $primaryKey = 'kode_dudi';

    // Disable auto-incrementing for non-integer primary key
    public $incrementing = false;

    // Type of the primary key
    protected $keyType = 'string';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_dudi',
        'nama_dudi',
        'password',
        'alamat_dudi',
        'notelp_dudi',
        'posisi_pkl'
    ];

    // Atur jika tidak menggunakan kolom timestamp (created_at, updated_at)
    public $timestamps = false;
}