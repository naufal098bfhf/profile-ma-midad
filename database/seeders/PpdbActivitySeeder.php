<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ppdb;
use App\Models\PpdbActivity;

class PpdbActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first PPDB
        $ppdb = Ppdb::first();
        
        if (!$ppdb) {
            $this->command->warn('No PPDB found. Please run PpdbSeeder first.');
            return;
        }

        // Sample activities
        $activities = [
            [
                'title' => 'Ekstrakurikuler Olahraga',
                'description' => 'Berbagai kegiatan olahraga seperti futsal, basket, voli, dan badminton untuk mengembangkan fisik dan sportivitas siswa.',
                'icon' => 'fas fa-futbol',
                'color' => '#28a745',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Kegiatan Keagamaan',
                'description' => 'Program keagamaan seperti tahfidz Al-Quran, kajian Islam, dan kegiatan keagamaan lainnya untuk memperkuat iman dan taqwa.',
                'icon' => 'fas fa-mosque',
                'color' => '#17a2b8',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Kegiatan Akademik',
                'description' => 'Program akademik seperti olimpiade sains, lomba matematika, dan kegiatan pembelajaran yang menantang untuk mengembangkan kemampuan akademik.',
                'icon' => 'fas fa-graduation-cap',
                'color' => '#007bff',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'title' => 'Kegiatan Seni & Budaya',
                'description' => 'Berbagai kegiatan seni seperti musik, tari, drama, dan kerajinan tangan untuk mengembangkan kreativitas dan apresiasi seni.',
                'icon' => 'fas fa-palette',
                'color' => '#6f42c1',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'title' => 'Kegiatan Kepemimpinan',
                'description' => 'Program kepemimpinan seperti OSIS, pramuka, dan organisasi siswa untuk mengembangkan jiwa kepemimpinan dan tanggung jawab.',
                'icon' => 'fas fa-users',
                'color' => '#fd7e14',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'title' => 'Kegiatan Sosial',
                'description' => 'Program sosial seperti bakti sosial, penggalangan dana, dan kegiatan kemanusiaan untuk mengembangkan kepedulian sosial.',
                'icon' => 'fas fa-hands-helping',
                'color' => '#dc3545',
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($activities as $activityData) {
            $ppdb->activities()->create($activityData);
        }

        $this->command->info('PPDB Activities seeded successfully!');
    }
}