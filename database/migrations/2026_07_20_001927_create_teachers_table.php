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
        Schema::create('teachers', function (Blueprint $table) {

            $table->id();

            // Foto Guru
            $table->string('photo');

            // Nama Lengkap
            $table->string('name');

            // Jabatan
            $table->string('position');

            // Mata Pelajaran
            $table->string('subject');

            // Pendidikan Terakhir
            $table->string('education');

            // Email
            $table->string('email')->nullable();

            // Nomor HP
            $table->string('phone')->nullable();

            // Biografi Singkat
            $table->text('description')->nullable();

            // Urutan Tampil
            $table->integer('sort_order')->default(1);

            // Status Aktif
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
