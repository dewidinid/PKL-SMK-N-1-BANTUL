<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePkl extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'tipe_pkl';

    // Primary key
    protected $primaryKey = 'kode_pkl';

    // Disable auto-incrementing for non-integer primary key
    public $incrementing = false;

    // Type of the primary key
    protected $keyType = 'string';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_pkl',
        'tipe_pkl'
    ];

    // Atur jika tidak menggunakan kolom timestamp (created_at, updated_at)
    public $timestamps = false;
}
