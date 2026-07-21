<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ppdb;
use App\Models\PpdbDocument;

class PpdbDocumentSeeder extends Seeder
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

        // Sample documents
        $documents = [
            [
                'name' => 'Formulir Pendaftaran PPDB',
                'description' => 'Formulir pendaftaran resmi untuk PPDB SMPIT Al-Itqon tahun ajaran 2024/2025',
                'file_name' => 'formulir_pendaftaran_ppdb_2024.pdf',
                'file_path' => 'ppdb/documents/sample_formulir.pdf',
                'file_type' => 'application/pdf',
                'file_size' => 245760, // 240KB
                'is_required' => true,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Panduan Pendaftaran Online',
                'description' => 'Panduan lengkap cara melakukan pendaftaran PPDB secara online',
                'file_name' => 'panduan_pendaftaran_online.pdf',
                'file_path' => 'ppdb/documents/sample_panduan.pdf',
                'file_type' => 'application/pdf',
                'file_size' => 512000, // 500KB
                'is_required' => false,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Persyaratan Dokumen',
                'description' => 'Daftar lengkap dokumen yang harus disiapkan untuk pendaftaran',
                'file_name' => 'persyaratan_dokumen.pdf',
                'file_path' => 'ppdb/documents/sample_persyaratan.pdf',
                'file_type' => 'application/pdf',
                'file_size' => 128000, // 125KB
                'is_required' => true,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Jadwal Seleksi PPDB',
                'description' => 'Jadwal lengkap tahapan seleksi PPDB dan tes masuk',
                'file_name' => 'jadwal_seleksi_ppdb.pdf',
                'file_path' => 'ppdb/documents/sample_jadwal.pdf',
                'file_type' => 'application/pdf',
                'file_size' => 89000, // 87KB
                'is_required' => false,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Template Surat Rekomendasi',
                'description' => 'Template surat rekomendasi dari kepala sekolah SD asal',
                'file_name' => 'template_surat_rekomendasi.docx',
                'file_path' => 'ppdb/documents/sample_rekomendasi.docx',
                'file_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'file_size' => 15600, // 15KB
                'is_required' => true,
                'is_active' => true,
                'sort_order' => 5
            ]
        ];

        foreach ($documents as $documentData) {
            $ppdb->documents()->create($documentData);
        }

        $this->command->info('PPDB Documents seeded successfully!');
    }
}