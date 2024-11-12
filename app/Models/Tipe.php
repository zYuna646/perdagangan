<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Handle the "creating" event to set slug from name.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tipe) {
            $tipe->slug = $tipe->slug ?? Str::slug($tipe->name);
        });
    }

    public function alat()
    {
        return $this->hasMany(Alat::class);
    }
}
