<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    use HasFactory;

    protected $table = 'pembimbing';
    protected $primaryKey = 'NIP_NIK';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'NIP_NIK',
        'nama_pembimbing',
        'password',
        'notelp_pembimbing',
    ];
}
