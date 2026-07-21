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
        Schema::create('ppdb_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_id')->constrained()->onDelete('cascade');
            $table->string('title'); // Judul kegiatan
            $table->text('description'); // Deskripsi kegiatan
            $table->string('image')->nullable(); // Gambar kegiatan
            $table->string('icon')->nullable(); // Icon kegiatan (Font Awesome)
            $table->string('color')->default('#007bff'); // Warna tema kegiatan
            $table->boolean('is_active')->default(true); // Status aktif/tidak
            $table->integer('sort_order')->default(0); // Urutan tampil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_activities');
    }
};