<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\PenaKarsa;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first Pena Karsa article
        $penaKarsa = PenaKarsa::first();
        
        if (!$penaKarsa) {
            $this->command->info('No Pena Karsa articles found. Please run PenaKarsaSeeder first.');
            return;
        }

        $comments = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@example.com',
                'comment' => 'Artikel yang sangat inspiratif! Terima kasih sudah berbagi pengalaman yang berharga. Semoga bisa menjadi motivasi untuk siswa-siswa lainnya.',
                'is_approved' => true,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@example.com',
                'comment' => 'Sangat setuju dengan poin-poin yang disampaikan. Sebagai orang tua, saya merasa artikel ini memberikan pandangan yang sangat baik tentang pendidikan.',
                'is_approved' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'comment' => 'Tulisan yang bagus dan mudah dipahami. Semoga penulis terus berkarya dan menginspirasi banyak orang.',
                'is_approved' => true,
            ],
            [
                'name' => 'Dewi Kartika',
                'email' => 'dewi.kartika@example.com',
                'comment' => 'Saya sangat terkesan dengan cara penulis menyampaikan ide-idenya. Keep up the good work!',
                'is_approved' => true,
            ],
            [
                'name' => 'Muhammad Fauzi',
                'email' => 'muhammad.fauzi@example.com',
                'comment' => 'Artikel yang sangat bermanfaat. Sebagai guru, saya akan membagikan ini kepada siswa-siswa saya.',
                'is_approved' => true,
            ],
            [
                'name' => 'Anita Sari',
                'email' => 'anita.sari@example.com',
                'comment' => 'Pendapat yang sangat menarik dan relevan dengan kondisi saat ini. Terima kasih sudah berbagi!',
                'is_approved' => false, // This comment is pending approval
            ],
        ];

        foreach ($comments as $commentData) {
            Comment::create([
                'pena_karsa_id' => $penaKarsa->id,
                'name' => $commentData['name'],
                'email' => $commentData['email'],
                'comment' => $commentData['comment'],
                'is_approved' => $commentData['is_approved'],
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            ]);
        }

        $this->command->info('Comments seeded successfully!');
    }
}
