<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class History extends Model
{
    use HasFactory;

    // (opsional) jika nama tabel bukan 'histories', set manual:
    // protected $table = 'histories';

    /**
     * Atribut yang boleh diisi secara massal.
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
     * Casting tipe data.
     */
    protected $casts = [
        // event_date & published_at disimpan sebagai timestamp/datetime di DB
        'event_date'   => 'datetime',
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    /**
     * Boot model: generate slug unik saat membuat/mengubah data.
     */
    protected static function booted(): void
    {
        // Saat create: pastikan slug ada & unik
        static::creating(function (History $history) {
            // Jika slug kosong, generate dari title
            if (empty($history->slug) && !empty($history->title)) {
                $history->slug = static::makeUniqueSlug($history->title);
            }

            // Normalisasi boolean default jika belum diisi
            if (is_null($history->is_published)) {
                $history->is_published = false;
            }
        });

        // Saat update: jika title berubah dan slug tidak diisi manual, perbarui slug unik
        static::updating(function (History $history) {
            if ($history->isDirty('title')) {
                // Jika user tidak memaksa slug baru secara manual, regenerate dari title
                if (!$history->isDirty('slug')) {
                    $history->slug = static::makeUniqueSlug($history->title, $history->id);
                } else {
                    // Jika slug diubah manual, tetap pastikan unik
                    $history->slug = static::ensureUniqueSlug($history->slug, $history->id);
                }
            } elseif ($history->isDirty('slug')) {
                // Title tidak berubah tapi slug diubah manual → pastikan unik
                $history->slug = static::ensureUniqueSlug($history->slug, $history->id);
            }
        });
    }

    /**
     * Generator slug unik berdasarkan title.
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
     * Pastikan slug yang diberikan unik (dipakai saat user set slug manual).
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
     * Relasi opsional ke Category (jika tabel categories ada).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Accessor URL gambar yang bisa langsung dipakai di Blade:
     * <img src="{{ $history->image_url }}">
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        // Jika sudah berupa URL penuh (mis. dari Supabase Storage public URL), kembalikan apa adanya
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        // Default: file disimpan di disk 'public' → storage/app/public/...
        // Pastikan sudah jalankan: php artisan storage:link
        return asset('storage/' . ltrim($this->image, '/'));
    }
}
