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
        Schema::create('ppdb_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nama dokumen (contoh: "Formulir Pendaftaran")
            $table->string('description')->nullable(); // Deskripsi singkat
            $table->string('file_path'); // Path file di storage
            $table->string('file_name'); // Nama file asli
            $table->string('file_type'); // MIME type (application/pdf, image/jpeg, dll)
            $table->integer('file_size'); // Ukuran file dalam bytes
            $table->boolean('is_required')->default(false); // Apakah dokumen wajib
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
        Schema::dropIfExists('ppdb_documents');
    }
};