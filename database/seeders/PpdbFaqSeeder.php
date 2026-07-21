<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ppdb;
use App\Models\PpdbFaq;

class PpdbFaqSeeder extends Seeder
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

        // Sample FAQs
        $faqs = [
            [
                'question' => 'Kapan pendaftaran PPDB dimulai?',
                'answer' => 'Pendaftaran PPDB dimulai pada tanggal 1 Januari 2024 dan berakhir pada tanggal 31 Maret 2024. Pendaftaran dilakukan secara online melalui website resmi sekolah.',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'question' => 'Berapa biaya pendaftaran PPDB?',
                'answer' => 'Biaya pendaftaran PPDB adalah Rp 150.000. Biaya ini sudah termasuk formulir pendaftaran, tes seleksi, dan administrasi. Pembayaran dapat dilakukan melalui transfer bank atau datang langsung ke sekolah.',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'question' => 'Apa saja persyaratan pendaftaran PPDB?',
                'answer' => 'Persyaratan pendaftaran meliputi:\n1. Fotokopi rapor kelas 5 dan 6 semester 1\n2. Fotokopi akta kelahiran\n3. Fotokopi kartu keluarga\n4. Pas foto 3x4 sebanyak 2 lembar\n5. Surat rekomendasi dari kepala sekolah SD asal\n6. Formulir pendaftaran yang sudah diisi lengkap',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'question' => 'Kapan jadwal tes seleksi PPDB?',
                'answer' => 'Tes seleksi PPDB akan dilaksanakan pada:\n- Tes Tulis: 15 April 2024\n- Tes Wawancara: 16-17 April 2024\n- Tes Baca Al-Quran: 18 April 2024\n\nSemua tes dilaksanakan di SMPIT Al-Itqon mulai pukul 08.00 WIB.',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'question' => 'Kapan pengumuman hasil seleksi?',
                'answer' => 'Pengumuman hasil seleksi PPDB akan diumumkan pada tanggal 25 April 2024 pukul 14.00 WIB. Hasil dapat dilihat di website sekolah dan papan pengumuman di sekolah.',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'question' => 'Berapa kuota siswa yang diterima?',
                'answer' => 'Kuota siswa yang diterima untuk tahun ajaran 2024/2025 adalah 120 siswa yang terbagi dalam 4 kelas dengan masing-masing kelas berisi 30 siswa.',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'question' => 'Apakah ada beasiswa untuk siswa berprestasi?',
                'answer' => 'Ya, sekolah menyediakan beasiswa untuk siswa berprestasi dengan kriteria:\n- Juara 1-3 tingkat kabupaten/kota\n- Juara 1-3 tingkat provinsi\n- Juara 1-3 tingkat nasional\n\nBeasiswa dapat berupa potongan SPP atau beasiswa penuh sesuai dengan prestasi yang diraih.',
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'question' => 'Bagaimana cara daftar PPDB online?',
                'answer' => 'Cara daftar PPDB online:\n1. Kunjungi website sekolah\n2. Klik menu PPDB\n3. Klik "Daftar Sekarang"\n4. Isi formulir pendaftaran\n5. Upload dokumen yang diperlukan\n6. Lakukan pembayaran\n7. Cetak bukti pendaftaran\n8. Tunggu konfirmasi dari panitia',
                'is_active' => true,
                'sort_order' => 8
            ]
        ];

        foreach ($faqs as $faqData) {
            $ppdb->faqs()->create($faqData);
        }

        $this->command->info('PPDB FAQs seeded successfully!');
    }
}