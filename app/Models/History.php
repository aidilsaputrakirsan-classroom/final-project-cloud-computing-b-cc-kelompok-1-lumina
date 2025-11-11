<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class History extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'event_date',
        'category_id',
        'is_published',
        'published_at',
    ];

    /**
     * Casting tipe data otomatis.
     */
    protected $casts = [
        'event_date'   => 'datetime',
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    /**
     * Relasi ke kategori (setiap sejarah punya satu kategori).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Boot model: generate slug unik saat membuat/mengubah data sejarah.
     */
    protected static function booted(): void
    {
        static::creating(function (History $history) {
            if (empty($history->slug) && !empty($history->title)) {
                $history->slug = static::makeUniqueSlug($history->title);
            }

            if (is_null($history->is_published)) {
                $history->is_published = false;
            }
        });

        static::updating(function (History $history) {
            if ($history->isDirty('title')) {
                if (!$history->isDirty('slug')) {
                    $history->slug = static::makeUniqueSlug($history->title, $history->id);
                } else {
                    $history->slug = static::ensureUniqueSlug($history->slug, $history->id);
                }
            } elseif ($history->isDirty('slug')) {
                $history->slug = static::ensureUniqueSlug($history->slug, $history->id);
            }
        });
    }

    /**
     * Membuat slug unik berdasarkan judul sejarah.
     */
    public static function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;

        while (static::query()
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /**
     * Pastikan slug yang diberikan tetap unik (jika diinput manual).
     */
    public static function ensureUniqueSlug(string $rawSlug, ?int $ignoreId = null): string
    {
        $base = Str::slug($rawSlug);
        $slug = $base;
        $i = 2;

        while (static::query()
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /**
     * Accessor URL gambar — langsung bisa dipakai di Blade.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        return asset('storage/' . ltrim($this->image, '/'));
    }
}
