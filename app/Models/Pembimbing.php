<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Gunakan Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembimbing extends Authenticatable
{
    use HasFactory;

    protected $table = 'pembimbing';
    protected $primaryKey = 'NIP_NIK';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'NIP_NIK',
        'nama_pembimbing',
        'jenis_kelamin',
        'jabatan',
        'alamat',
        'no_telp',
        'password',
    ];
}
