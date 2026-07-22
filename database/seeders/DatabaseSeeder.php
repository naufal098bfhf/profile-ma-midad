<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin MA Miftahul Midad',
            'email' => 'mamiftahulmidad@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        $this->call([
            ArticleSeeder::class,
            DocumentSeeder::class,
            AnnouncementCategorySeeder::class,
            GalleryCategorySeeder::class,
            GallerySeeder::class,
            SliderSeeder::class,
        ]);
    }
}
