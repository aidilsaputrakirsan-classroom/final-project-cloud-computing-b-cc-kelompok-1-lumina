<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: menambahkan kolom category_id ke tabel histories.
     */
    public function up(): void
    {
        Schema::table('histories', function (Blueprint $table) {
            // Tambahkan kolom relasi ke tabel categories
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories')
                  ->nullOnDelete(); // sama seperti ->onDelete('set null')
        });
    }

    /**
     * Rollback migrasi: hapus kolom category_id dari tabel histories.
     */
    public function down(): void
    {
        Schema::table('histories', function (Blueprint $table) {
            // Hapus foreign key & kolomnya
            $table->dropConstrainedForeignId('category_id');
        });
    }
};
