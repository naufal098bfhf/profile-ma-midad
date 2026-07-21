SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `ppdbs`;
CREATE TABLE `ppdbs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `registration_start` date NOT NULL,
  `registration_end` date NOT NULL,
  `registration_fee` decimal(10,2) NOT NULL,
  `quota` int NOT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `test_schedule` text COLLATE utf8mb4_unicode_ci,
  `announcement_schedule` text COLLATE utf8mb4_unicode_ci,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_images` json DEFAULT NULL,
  `facilities` json DEFAULT NULL,
  `activities` json DEFAULT NULL,
  `faqs` json DEFAULT NULL,
  `documents` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ppdbs_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `ppdbs` (`id`,`title`,`slug`,`description`,`content`,`registration_start`,`registration_end`,`registration_fee`,`quota`,`requirements`,`test_schedule`,`announcement_schedule`,`contact_phone`,`contact_email`,`status`,`is_featured`,`hero_image`,`gallery_images`,`facilities`,`activities`,`faqs`,`documents`,`created_at`,`updated_at`) VALUES
('1','Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran 2024/2025','ppdb-tahun-ajaran-2024-2025','Bergabunglah dengan keluarga besar SMPIT Al-Itqon untuk meraih prestasi terbaik dalam pendidikan Islami yang berkualitas. Pendaftaran dibuka mulai 1 Januari - 31 Maret 2024.','SMPIT Al-Itqon membuka pendaftaran untuk siswa baru tahun ajaran 2024/2025. Kami menyediakan pendidikan berkualitas dengan kurikulum yang mengintegrasikan nilai-nilai Islam dalam setiap aspek pembelajaran.','2024-01-01','2026-01-31','150000.00','120','1. Fotokopi rapor kelas 5 dan 6 SD\r\n2. Fotokopi ijazah SD\r\n3. Pas foto 3x4 (3 lembar)\r\n4. Fotokopi akta kelahiran\r\n5. Fotokopi kartu keluarga','Tes tulis akan dilaksanakan pada:\r\n- Tanggal: 10 April 2024\r\n- Waktu: 08.00 - 12.00 WIB\r\n- Tempat: SMPIT Al-Itqon\r\n- Materi: Matematika, Bahasa Indonesia, dan IPA','Pengumuman hasil seleksi:\r\n- Tanggal: 15 April 2024\r\n- Waktu: 14.00 WIB\r\n- Tempat: Website sekolah dan papan pengumuman','(021) 1234-5678','info@smpitalitqon.sch.id','active','1',NULL,NULL,'[{\"icon\": \"fas fa-desktop\", \"name\": \"Laboratorium Komputer\", \"description\": \"Laboratorium komputer modern dengan 30 unit komputer untuk pembelajaran IT\"}, {\"icon\": \"fas fa-flask\", \"name\": \"Laboratorium IPA\", \"description\": \"Laboratorium IPA lengkap dengan peralatan praktikum fisika, kimia, dan biologi\"}, {\"icon\": \"fas fa-book\", \"name\": \"Perpustakaan\", \"description\": \"Perpustakaan dengan koleksi buku lengkap dan ruang baca yang nyaman\"}, {\"icon\": \"fas fa-futbol\", \"name\": \"Lapangan Olahraga\", \"description\": \"Lapangan olahraga luas untuk berbagai kegiatan olahraga dan ekstrakurikuler\"}, {\"icon\": \"fas fa-mosque\", \"name\": \"Masjid\", \"description\": \"Masjid yang nyaman untuk kegiatan ibadah dan pembelajaran agama\"}, {\"icon\": \"fas fa-utensils\", \"name\": \"Kantin Sehat\", \"description\": \"Kantin yang menyediakan makanan sehat dan bergizi untuk siswa\"}]','[{\"image\": \"public/template/images/activities/learning.jpg\", \"title\": \"Kegiatan Belajar Mengajar\", \"description\": \"Proses pembelajaran yang interaktif dan menyenangkan\"}, {\"image\": \"public/template/images/activities/extra.jpg\", \"title\": \"Ekstrakurikuler\", \"description\": \"Berbagai kegiatan ekstrakurikuler untuk mengembangkan bakat siswa\"}, {\"image\": \"public/template/images/activities/religious.jpg\", \"title\": \"Kegiatan Keagamaan\", \"description\": \"Pembinaan karakter islami melalui berbagai kegiatan keagamaan\"}, {\"image\": \"public/template/images/activities/social.jpg\", \"title\": \"Kegiatan Sosial\", \"description\": \"Mengasah kepedulian sosial melalui berbagai kegiatan sosial\"}]','[{\"answer\": \"Pendaftaran PPDB dibuka mulai tanggal 1 Januari 2024 hingga 31 Maret 2024. Pendaftaran dilakukan secara online melalui website resmi sekolah.\", \"question\": \"Kapan pendaftaran PPDB dibuka?\"}, {\"answer\": \"Persyaratan meliputi: 1) Fotokopi rapor kelas 5 dan 6 SD, 2) Fotokopi ijazah SD, 3) Pas foto 3x4 (3 lembar), 4) Fotokopi akta kelahiran, 5) Fotokopi kartu keluarga.\", \"question\": \"Apa saja persyaratan pendaftaran?\"}, {\"answer\": \"Biaya pendaftaran PPDB sebesar Rp 150.000,- yang dapat dibayarkan melalui transfer bank atau datang langsung ke sekolah.\", \"question\": \"Berapa biaya pendaftaran?\"}, {\"answer\": \"Pengumuman hasil seleksi akan diumumkan pada tanggal 15 April 2024 melalui website sekolah dan papan pengumuman di sekolah.\", \"question\": \"Kapan pengumuman hasil seleksi?\"}, {\"answer\": \"Ya, ada tes tulis yang meliputi mata pelajaran Matematika, Bahasa Indonesia, dan IPA. Tes akan dilaksanakan pada tanggal 10 April 2024.\", \"question\": \"Apakah ada tes masuk?\"}, {\"answer\": \"Kunjungi halaman PPDB di website sekolah, klik tombol \\\"Daftar Sekarang\\\", isi formulir pendaftaran, upload dokumen yang diperlukan, dan lakukan pembayaran.\", \"question\": \"Bagaimana cara daftar online?\"}]','[{\"url\": \"#\", \"type\": \"pdf\", \"title\": \"Formulir Pendaftaran PPDB\"}, {\"url\": \"#\", \"type\": \"pdf\", \"title\": \"Panduan Pendaftaran Online\"}, {\"url\": \"#\", \"type\": \"pdf\", \"title\": \"Jadwal Tes Masuk\"}]','2025-09-11 05:06:10','2025-09-11 05:43:29');
DROP TABLE IF EXISTS `ppdb_documents`;
CREATE TABLE `ppdb_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ppdb_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ppdb_documents_ppdb_id_foreign` (`ppdb_id`),
  CONSTRAINT `ppdb_documents_ppdb_id_foreign` FOREIGN KEY (`ppdb_id`) REFERENCES `ppdbs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `ppdb_documents` (`id`,`ppdb_id`,`name`,`description`,`file_path`,`file_name`,`file_type`,`file_size`,`is_required`,`is_active`,`sort_order`,`created_at`,`updated_at`) VALUES
('1','1','Formulir Pendaftaran PPDB','Formulir pendaftaran resmi untuk PPDB SMPIT Al-Itqon tahun ajaran 2024/2025','ppdb/documents/sample_formulir.pdf','formulir_pendaftaran_ppdb_2024.pdf','application/pdf','245760','1','1','1','2025-09-11 05:29:57','2025-09-11 05:29:57'),
('2','1','Panduan Pendaftaran Online','Panduan lengkap cara melakukan pendaftaran PPDB secara online','ppdb/documents/sample_panduan.pdf','panduan_pendaftaran_online.pdf','application/pdf','512000','0','1','2','2025-09-11 05:29:57','2025-09-11 05:29:57'),
('3','1','Persyaratan Dokumen','Daftar lengkap dokumen yang harus disiapkan untuk pendaftaran','ppdb/documents/sample_persyaratan.pdf','persyaratan_dokumen.pdf','application/pdf','128000','1','1','3','2025-09-11 05:29:57','2025-09-11 05:29:57'),
('4','1','Jadwal Seleksi PPDB','Jadwal lengkap tahapan seleksi PPDB dan tes masuk','ppdb/documents/sample_jadwal.pdf','jadwal_seleksi_ppdb.pdf','application/pdf','89000','0','1','4','2025-09-11 05:29:57','2025-09-11 05:29:57'),
('5','1','Template Surat Rekomendasi','Template surat rekomendasi dari kepala sekolah SD asal','ppdb/documents/sample_rekomendasi.docx','template_surat_rekomendasi.docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','15600','1','1','5','2025-09-11 05:29:57','2025-09-11 05:29:57');
DROP TABLE IF EXISTS `ppdb_faqs`;
CREATE TABLE `ppdb_faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ppdb_id` bigint unsigned NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ppdb_faqs_ppdb_id_foreign` (`ppdb_id`),
  CONSTRAINT `ppdb_faqs_ppdb_id_foreign` FOREIGN KEY (`ppdb_id`) REFERENCES `ppdbs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `ppdb_faqs` (`id`,`ppdb_id`,`question`,`answer`,`is_active`,`sort_order`,`created_at`,`updated_at`) VALUES
('1','1','Kapan pendaftaran PPDB dimulai?','Pendaftaran PPDB dimulai pada tanggal 1 Januari 2024 dan berakhir pada tanggal 31 Maret 2024. Pendaftaran dilakukan secara online melalui website resmi sekolah.','1','1','2025-09-11 05:35:02','2025-09-11 05:35:02'),
('2','1','Berapa biaya pendaftaran PPDB?','Biaya pendaftaran PPDB adalah Rp 150.000. Biaya ini sudah termasuk formulir pendaftaran, tes seleksi, dan administrasi. Pembayaran dapat dilakukan melalui transfer bank atau datang langsung ke sekolah.','1','2','2025-09-11 05:35:02','2025-09-11 05:35:02'),
('3','1','Apa saja persyaratan pendaftaran PPDB?','Persyaratan pendaftaran meliputi:\\n1. Fotokopi rapor kelas 5 dan 6 semester 1\\n2. Fotokopi akta kelahiran\\n3. Fotokopi kartu keluarga\\n4. Pas foto 3x4 sebanyak 2 lembar\\n5. Surat rekomendasi dari kepala sekolah SD asal\\n6. Formulir pendaftaran yang sudah diisi lengkap','1','3','2025-09-11 05:35:02','2025-09-11 05:35:02'),
('4','1','Kapan jadwal tes seleksi PPDB?','Tes seleksi PPDB akan dilaksanakan pada:\\n- Tes Tulis: 15 April 2024\\n- Tes Wawancara: 16-17 April 2024\\n- Tes Baca Al-Quran: 18 April 2024\\n\\nSemua tes dilaksanakan di SMPIT Al-Itqon mulai pukul 08.00 WIB.','1','4','2025-09-11 05:35:02','2025-09-11 05:35:02'),
('5','1','Kapan pengumuman hasil seleksi?','Pengumuman hasil seleksi PPDB akan diumumkan pada tanggal 25 April 2024 pukul 14.00 WIB. Hasil dapat dilihat di website sekolah dan papan pengumuman di sekolah.','1','5','2025-09-11 05:35:02','2025-09-11 05:35:02'),
('6','1','Berapa kuota siswa yang diterima?','Kuota siswa yang diterima untuk tahun ajaran 2024/2025 adalah 120 siswa yang terbagi dalam 4 kelas dengan masing-masing kelas berisi 30 siswa.','1','6','2025-09-11 05:35:02','2025-09-11 05:35:02'),
('7','1','Apakah ada beasiswa untuk siswa berprestasi?','Ya, sekolah menyediakan beasiswa untuk siswa berprestasi dengan kriteria:\\n- Juara 1-3 tingkat kabupaten/kota\\n- Juara 1-3 tingkat provinsi\\n- Juara 1-3 tingkat nasional\\n\\nBeasiswa dapat berupa potongan SPP atau beasiswa penuh sesuai dengan prestasi yang diraih.','1','7','2025-09-11 05:35:02','2025-09-11 05:35:02'),
('8','1','Bagaimana cara daftar PPDB online?','Cara daftar PPDB online:\\n1. Kunjungi website sekolah\\n2. Klik menu PPDB\\n3. Klik \"Daftar Sekarang\"\\n4. Isi formulir pendaftaran\\n5. Upload dokumen yang diperlukan\\n6. Lakukan pembayaran\\n7. Cetak bukti pendaftaran\\n8. Tunggu konfirmasi dari panitia','1','8','2025-09-11 05:35:02','2025-09-11 05:35:02');
DROP TABLE IF EXISTS `ppdb_activities`;
CREATE TABLE `ppdb_activities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ppdb_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#007bff',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ppdb_activities_ppdb_id_foreign` (`ppdb_id`),
  CONSTRAINT `ppdb_activities_ppdb_id_foreign` FOREIGN KEY (`ppdb_id`) REFERENCES `ppdbs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `ppdb_activities` (`id`,`ppdb_id`,`title`,`description`,`image`,`icon`,`color`,`is_active`,`sort_order`,`created_at`,`updated_at`) VALUES
('1','1','Ekstrakurikuler Olahraga','Berbagai kegiatan olahraga seperti futsal, basket, voli, dan badminton untuk mengembangkan fisik dan sportivitas siswa.',NULL,'fas fa-futbol','#ffffff','1','1','2025-09-11 05:46:37','2025-09-11 05:51:56'),
('2','1','Kegiatan Keagamaan','Program keagamaan seperti tahfidz Al-Quran, kajian Islam, dan kegiatan keagamaan lainnya untuk memperkuat iman dan taqwa.',NULL,'fas fa-mosque','#17a2b8','1','2','2025-09-11 05:46:37','2025-09-11 05:46:37'),
('3','1','Kegiatan Akademik','Program akademik seperti olimpiade sains, lomba matematika, dan kegiatan pembelajaran yang menantang untuk mengembangkan kemampuan akademik.',NULL,'fas fa-graduation-cap','#007bff','1','3','2025-09-11 05:46:37','2025-09-11 05:46:37'),
('4','1','Kegiatan Seni & Budaya','Berbagai kegiatan seni seperti musik, tari, drama, dan kerajinan tangan untuk mengembangkan kreativitas dan apresiasi seni.',NULL,'fas fa-palette','#6f42c1','1','4','2025-09-11 05:46:37','2025-09-11 05:46:37'),
('5','1','Kegiatan Kepemimpinan','Program kepemimpinan seperti OSIS, pramuka, dan organisasi siswa untuk mengembangkan jiwa kepemimpinan dan tanggung jawab.',NULL,'fas fa-users','#fd7e14','1','5','2025-09-11 05:46:37','2025-09-11 05:46:37'),
('6','1','Kegiatan Sosial','Program sosial seperti bakti sosial, penggalangan dana, dan kegiatan kemanusiaan untuk mengembangkan kepedulian sosial.',NULL,'fas fa-hands-helping','#dc3545','1','6','2025-09-11 05:46:37','2025-09-11 05:46:37');
SET FOREIGN_KEY_CHECKS=1;
