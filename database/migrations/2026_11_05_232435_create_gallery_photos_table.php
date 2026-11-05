
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_photos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('gallery_id')
                ->constrained('galleries')
                ->cascadeOnDelete();

            $table->string('image');
            $table->string('thumbnail')->nullable();

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['gallery_id', 'sort_order']);
        });

        // Migrasikan foto lama menjadi foto dalam album.
        $oldGalleries = DB::table('galleries')
            ->whereNotNull('image')
            ->get();

        foreach ($oldGalleries as $gallery) {
            DB::table('gallery_photos')->insert([
                'gallery_id' => $gallery->id,
                'image' => $gallery->image,
                'thumbnail' => $gallery->thumbnail,
                'sort_order' => 0,
                'created_at' => $gallery->created_at,
                'updated_at' => $gallery->updated_at,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_photos');
    }
};
