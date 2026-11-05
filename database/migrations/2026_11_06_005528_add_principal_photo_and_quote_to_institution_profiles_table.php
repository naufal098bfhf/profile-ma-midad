<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institution_profiles', function (Blueprint $table) {
            $table->string('principal_photo')->nullable();
            $table->text('principal_quote')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('institution_profiles', function (Blueprint $table) {
            $table->dropColumn(['principal_photo', 'principal_quote']);
        });
    }
};
