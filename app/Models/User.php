<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Nama tabel
    protected $primaryKey = 'id_user'; // Primary key
    public $timestamps = true; // Aktifkan timestamps

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    // Hidden untuk password saat serialisasi
    protected $hidden = [
        'password',
    ];

    // Casting ke tipe data lain jika diperlukan
    protected $casts = [
        'role' => 'string',
    ];
}
