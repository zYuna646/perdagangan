<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = [
        'nama_kegiatan',
        'tanggal_kegiatan',
        'lokasi_kegiatan',
        'foto_kegiatan',
    ];

    // Cast foto_kegiatan as an array if storing multiple images
    protected $casts = [
        'foto_kegiatan' => 'array',
    ];
}
