<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    /**
     * Casting otomatis untuk kolom boolean.
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke model History (satu kategori memiliki banyak sejarah).
     */
    public function histories()
    {
        return $this->hasMany(History::class);
    }

    /**
     * Boot model: generate slug unik saat membuat/mengubah data kategori.
     */
    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            if (empty($category->slug) && !empty($category->name)) {
                $category->slug = static::makeUniqueSlug($category->name);
            }
        });

        static::updating(function (Category $category) {
            if ($category->isDirty('name')) {
                if (!$category->isDirty('slug')) {
                    $category->slug = static::makeUniqueSlug($category->name, $category->id);
                } else {
                    $category->slug = static::ensureUniqueSlug($category->slug, $category->id);
                }
            } elseif ($category->isDirty('slug')) {
                $category->slug = static::ensureUniqueSlug($category->slug, $category->id);
            }
        });
    }

    /**
     * Membuat slug unik berdasarkan nama kategori.
     */
    public static function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
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
     * Pastikan slug yang diberikan tetap unik.
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
}
