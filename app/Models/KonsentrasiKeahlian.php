<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsentrasiKeahlian extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'konsentrasi_keahlian';

    // Primary key
    protected $primaryKey = 'kode_konsentrasi';

    // Disable auto-incrementing for non-integer primary key
    public $incrementing = false;

    // Type of the primary key
    protected $keyType = 'string';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_konsentrasi',
        'nama_konsentrasi'
    ];

    // Atur jika tidak menggunakan kolom timestamp (created_at, updated_at)
    public $timestamps = false;
}
