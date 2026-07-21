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
        Schema::create('ppdbs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('content')->nullable();
            $table->date('registration_start');
            $table->date('registration_end');
            $table->decimal('registration_fee', 10, 2);
            $table->integer('quota');
            $table->text('requirements')->nullable();
            $table->text('test_schedule')->nullable();
            $table->text('announcement_schedule')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('status')->default('active'); // active, inactive, draft
            $table->boolean('is_featured')->default(false);
            $table->string('hero_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('facilities')->nullable();
            $table->json('activities')->nullable();
            $table->json('faqs')->nullable();
            $table->json('documents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdbs');
    }
};
