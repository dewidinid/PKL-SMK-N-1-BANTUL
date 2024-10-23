<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin'; // Nama tabel
    protected $primaryKey = 'kode_admin'; // Primary key
    public $incrementing = false; // Jika primary key bukan auto-increment
    protected $keyType = 'string'; // Tipe data primary key

    public $timestamps = true; // Aktifkan timestamps

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_admin',
        'password',
        // 'surat_pengajuan',
    ];

    // Hidden untuk password saat serialisasi
    protected $hidden = [
        'password',
    ];

    // Casting surat_pengajuan ke boolean
    // protected $casts = [
    //     'surat_pengajuan' => 'boolean',
    // ];
}
