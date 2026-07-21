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
        Schema::create('ppdb_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_id')->constrained()->onDelete('cascade');
            $table->string('question'); // Pertanyaan FAQ
            $table->text('answer'); // Jawaban FAQ
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
        Schema::dropIfExists('ppdb_faqs');
    }
};