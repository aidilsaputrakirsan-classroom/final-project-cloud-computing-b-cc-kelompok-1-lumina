<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    // Nama tabel -> default "destinations", jadi ini boleh tidak ditulis
    // protected $table = 'destinations';

    // Kolom yang boleh di-mass assign
    protected $fillable = [
        'name',        // nama tempat wisata
        'description', // deskripsi
        'location',    // link google maps
    ];
}
