<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'details',
    ];

    // Relasi ke User (biar bisa ambil nama)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}