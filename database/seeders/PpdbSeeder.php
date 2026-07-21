<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ppdb;
use Carbon\Carbon;

class PpdbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ppdb = Ppdb::create([
            'title' => 'Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran 2024/2025',
            'slug' => 'ppdb-tahun-ajaran-2024-2025',
            'description' => 'Bergabunglah dengan keluarga besar SMPIT Al-Itqon untuk meraih prestasi terbaik dalam pendidikan Islami yang berkualitas. Pendaftaran dibuka mulai 1 Januari - 31 Maret 2024.',
            'content' => 'SMPIT Al-Itqon membuka pendaftaran untuk siswa baru tahun ajaran 2024/2025. Kami menyediakan pendidikan berkualitas dengan kurikulum yang mengintegrasikan nilai-nilai Islam dalam setiap aspek pembelajaran.',
            'registration_start' => Carbon::create(2024, 1, 1),
            'registration_end' => Carbon::create(2024, 3, 31),
            'registration_fee' => 150000,
            'quota' => 120,
            'requirements' => "1. Fotokopi rapor kelas 5 dan 6 SD\n2. Fotokopi ijazah SD\n3. Pas foto 3x4 (3 lembar)\n4. Fotokopi akta kelahiran\n5. Fotokopi kartu keluarga",
            'test_schedule' => "Tes tulis akan dilaksanakan pada:\n- Tanggal: 10 April 2024\n- Waktu: 08.00 - 12.00 WIB\n- Tempat: SMPIT Al-Itqon\n- Materi: Matematika, Bahasa Indonesia, dan IPA",
            'announcement_schedule' => "Pengumuman hasil seleksi:\n- Tanggal: 15 April 2024\n- Waktu: 14.00 WIB\n- Tempat: Website sekolah dan papan pengumuman",
            'contact_phone' => '(021) 1234-5678',
            'contact_email' => 'info@smpitalitqon.sch.id',
            'status' => 'active',
            'is_featured' => true,
            'facilities' => [
                [
                    'name' => 'Laboratorium Komputer',
                    'description' => 'Laboratorium komputer modern dengan 30 unit komputer untuk pembelajaran IT',
                    'icon' => 'fas fa-desktop'
                ],
                [
                    'name' => 'Laboratorium IPA',
                    'description' => 'Laboratorium IPA lengkap dengan peralatan praktikum fisika, kimia, dan biologi',
                    'icon' => 'fas fa-flask'
                ],
                [
                    'name' => 'Perpustakaan',
                    'description' => 'Perpustakaan dengan koleksi buku lengkap dan ruang baca yang nyaman',
                    'icon' => 'fas fa-book'
                ],
                [
                    'name' => 'Lapangan Olahraga',
                    'description' => 'Lapangan olahraga luas untuk berbagai kegiatan olahraga dan ekstrakurikuler',
                    'icon' => 'fas fa-futbol'
                ],
                [
                    'name' => 'Masjid',
                    'description' => 'Masjid yang nyaman untuk kegiatan ibadah dan pembelajaran agama',
                    'icon' => 'fas fa-mosque'
                ],
                [
                    'name' => 'Kantin Sehat',
                    'description' => 'Kantin yang menyediakan makanan sehat dan bergizi untuk siswa',
                    'icon' => 'fas fa-utensils'
                ]
            ],
            'activities' => [
                [
                    'title' => 'Kegiatan Belajar Mengajar',
                    'description' => 'Proses pembelajaran yang interaktif dan menyenangkan',
                    'image' => 'public/template/images/activities/learning.jpg'
                ],
                [
                    'title' => 'Ekstrakurikuler',
                    'description' => 'Berbagai kegiatan ekstrakurikuler untuk mengembangkan bakat siswa',
                    'image' => 'public/template/images/activities/extra.jpg'
                ],
                [
                    'title' => 'Kegiatan Keagamaan',
                    'description' => 'Pembinaan karakter islami melalui berbagai kegiatan keagamaan',
                    'image' => 'public/template/images/activities/religious.jpg'
                ],
                [
                    'title' => 'Kegiatan Sosial',
                    'description' => 'Mengasah kepedulian sosial melalui berbagai kegiatan sosial',
                    'image' => 'public/template/images/activities/social.jpg'
                ]
            ],
            'faqs' => [
                [
                    'question' => 'Kapan pendaftaran PPDB dibuka?',
                    'answer' => 'Pendaftaran PPDB dibuka mulai tanggal 1 Januari 2024 hingga 31 Maret 2024. Pendaftaran dilakukan secara online melalui website resmi sekolah.'
                ],
                [
                    'question' => 'Apa saja persyaratan pendaftaran?',
                    'answer' => 'Persyaratan meliputi: 1) Fotokopi rapor kelas 5 dan 6 SD, 2) Fotokopi ijazah SD, 3) Pas foto 3x4 (3 lembar), 4) Fotokopi akta kelahiran, 5) Fotokopi kartu keluarga.'
                ],
                [
                    'question' => 'Berapa biaya pendaftaran?',
                    'answer' => 'Biaya pendaftaran PPDB sebesar Rp 150.000,- yang dapat dibayarkan melalui transfer bank atau datang langsung ke sekolah.'
                ],
                [
                    'question' => 'Kapan pengumuman hasil seleksi?',
                    'answer' => 'Pengumuman hasil seleksi akan diumumkan pada tanggal 15 April 2024 melalui website sekolah dan papan pengumuman di sekolah.'
                ],
                [
                    'question' => 'Apakah ada tes masuk?',
                    'answer' => 'Ya, ada tes tulis yang meliputi mata pelajaran Matematika, Bahasa Indonesia, dan IPA. Tes akan dilaksanakan pada tanggal 10 April 2024.'
                ],
                [
                    'question' => 'Bagaimana cara daftar online?',
                    'answer' => 'Kunjungi halaman PPDB di website sekolah, klik tombol "Daftar Sekarang", isi formulir pendaftaran, upload dokumen yang diperlukan, dan lakukan pembayaran.'
                ]
            ],
            'documents' => [
                [
                    'title' => 'Formulir Pendaftaran PPDB',
                    'url' => '#',
                    'type' => 'pdf'
                ],
                [
                    'title' => 'Panduan Pendaftaran Online',
                    'url' => '#',
                    'type' => 'pdf'
                ],
                [
                    'title' => 'Jadwal Tes Masuk',
                    'url' => '#',
                    'type' => 'pdf'
                ]
            ]
        ]);

        $this->command->info('PPDB data seeded successfully!');
    }
}
