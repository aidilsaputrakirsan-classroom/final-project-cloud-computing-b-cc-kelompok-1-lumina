<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('title');          // Judul sejarah
            $table->string('image')->nullable(); // Gambar sejarah (opsional)
            $table->text('content');          // Bacaan/artikel
            $table->date('event_date');       // Tanggal peristiwa
            $table->timestamps();             // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
