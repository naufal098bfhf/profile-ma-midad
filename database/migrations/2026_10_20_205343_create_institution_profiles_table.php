
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institution_profiles', function (Blueprint $table) {
            $table->id();

            // A. Identitas Madrasah
            $table->string('name')->default('MA Miftahul Midad');
            $table->string('nsm')->nullable();
            $table->string('npsn')->nullable();
            $table->string('establishment_charter')->nullable();
            $table->string('operational_license')->nullable();
            $table->string('founded_at')->nullable();
            $table->text('address')->nullable();
            $table->string('village')->nullable();
            $table->string('district')->nullable();
            $table->string('regency')->default('Lumajang');
            $table->string('postal_code', 10)->nullable();
            $table->string('province')->default('Jawa Timur');
            $table->string('accreditation')->nullable();
            $table->string('foundation')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('website')->nullable();

            // B. Kepala Madrasah
            $table->string('principal_name')->nullable();
            $table->string('principal_period')->nullable();

            // C. Peserta Didik dan Rombongan Belajar
            $table->string('academic_year')->nullable();
            $table->unsignedInteger('class_x_male')->default(0);
            $table->unsignedInteger('class_x_female')->default(0);
            $table->unsignedInteger('class_xi_male')->default(0);
            $table->unsignedInteger('class_xi_female')->default(0);
            $table->unsignedInteger('class_xii_male')->default(0);
            $table->unsignedInteger('class_xii_female')->default(0);
            $table->unsignedInteger('class_x_rombel')->default(0);
            $table->unsignedInteger('class_xi_rombel')->default(0);
            $table->unsignedInteger('class_xii_rombel')->default(0);

            // D. Alumni
            $table->string('alumni_year')->nullable();
            $table->unsignedInteger('alumni_male')->default(0);
            $table->unsignedInteger('alumni_female')->default(0);

            // E. Tenaga Pendidik dan Kependidikan
            $table->unsignedInteger('staff_smu')->default(0);
            $table->unsignedInteger('staff_d3')->default(0);
            $table->unsignedInteger('staff_s1')->default(0);
            $table->unsignedInteger('staff_s2')->default(0);
            $table->unsignedInteger('staff_s3')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institution_profiles');
    }
};
