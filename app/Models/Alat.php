<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'tipe_id',
        'no_seri',
        'tanggal_tera',
        'masa_berlaku_start',
        'masa_berlaku_end',
        'keterangan'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tipe()
    {
        return $this->belongsTo(Tipe::class);
    }
}
