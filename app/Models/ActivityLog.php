<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'details',
    ];

    // Sambungkan ke tabel User biar bisa ambil nama user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}