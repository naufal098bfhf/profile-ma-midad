{{-- resources/views/institution-profile/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Profil Madrasah - MA Miftahul Midad</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>

/* =====================================================
   MA MIFTAHUL MIDAD
   VISUAL DESIGN SYSTEM — TURQUOISE
   Tampilan saja, tidak mengubah fungsi Blade
   ===================================================== */

:root {
    --brand-primary: #10A596;
    --brand-primary-hover: #0D8176;
    --brand-dark: #087F74;
    --brand-light: #E7F7F4;
    --brand-background: #F7FBFA;
    --brand-white: #FFFFFF;
    --brand-text: #243746;
    --brand-muted: #64748B;
    --brand-border: #DCEBE8;
    --brand-shadow: 0 8px 28px rgba(16, 165, 150, 0.08);
    --brand-shadow-hover: 0 16px 36px rgba(16, 165, 150, 0.14);
    --brand-radius: 18px;

    /* Alias agar CSS lama ikut memakai warna baru */
    --profile-blue: #10A596;
    --profile-green: #10A596;
    --profile-light: #F7FBFA;
    --vm-green: #10A596;
    --vm-green-dark: #087F74;
    --vm-gold: #10A596;
    --vm-cream: #E7F7F4;
}

/* =====================================================
   DASAR HALAMAN
   ===================================================== */

html {
    scroll-behavior: smooth;
    scroll-padding-top: 90px;
}

body {
    margin: 0;
    background: var(--brand-background);
    color: var(--brand-text);
    font-family: "Inter", "Segoe UI", Arial, sans-serif;
    font-size: 15px;
    line-height: 1.75;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
}

::selection {
    background: rgba(16, 165, 150, 0.2);
    color: var(--brand-dark);
}

img {
    max-width: 100%;
}

a {
    color: var(--brand-dark);
    text-decoration-thickness: 1px;
    text-underline-offset: 3px;
    transition: color 0.2s ease;
}

a:hover {
    color: var(--brand-primary-hover);
}

/* =====================================================
   NAVBAR PUBLIK
   ===================================================== */

.navbar,
nav.navbar {
    border-bottom: 1px solid var(--brand-border);
}

.navbar .navbar-brand,
.navbar .nav-link {
    transition: color 0.2s ease;
}

.navbar .nav-link {
    font-weight: 600;
}

.navbar .nav-link:hover,
.navbar .nav-link.active {
    color: var(--brand-primary) !important;
}

.navbar .navbar-brand {
    color: var(--brand-dark);
    font-weight: 800;
}

.navbar .navbar-toggler {
    border-color: var(--brand-border);
    box-shadow: none;
}

.navbar .navbar-toggler:focus {
    box-shadow: 0 0 0 3px rgba(16, 165, 150, 0.16);
}

/* =====================================================
   HERO PROFIL MADRASAH
   ===================================================== */

.profile-hero {
    position: relative;
    overflow: hidden;
    padding: 86px 0;
    color: var(--brand-white);
    background: linear-gradient(
        135deg,
        #087F74 0%,
        #10A596 55%,
        #24B7A7 100%
    );
}

.profile-hero::before {
    content: "";
    position: absolute;
    width: 350px;
    height: 350px;
    top: -180px;
    right: 8%;
    border: 1px solid rgba(255, 255, 255, 0.18);
    border-radius: 50%;
    pointer-events: none;
}

.profile-hero::after {
    border-color: rgba(255, 255, 255, 0.12);
    pointer-events: none;
}

.profile-hero .container {
    position: relative;
    z-index: 1;
}

.profile-hero h1 {
    margin-bottom: 20px;
    color: var(--brand-white);
    font-size: clamp(2.1rem, 5vw, 3.6rem);
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: -1.1px;
}

.profile-hero .lead {
    max-width: 680px;
    color: rgba(255, 255, 255, 0.9);
    font-size: clamp(1rem, 2vw, 1.2rem);
    line-height: 1.8;
}

.hero-label {
    color: #D5FFF7;
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 2.5px;
}

.profile-hero .badge {
    padding: 10px 16px !important;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.95) !important;
    color: var(--brand-dark) !important;
    font-size: 0.8rem;
    font-weight: 700;
}

/* Panel identitas di dalam hero */
.profile-hero .rounded-4 {
    border: 1px solid rgba(255, 255, 255, 0.24) !important;
    border-radius: 22px !important;
    background: rgba(255, 255, 255, 0.12) !important;
    box-shadow: 0 18px 45px rgba(0, 60, 54, 0.12);
    backdrop-filter: blur(8px);
}

.profile-hero .rounded-4 .small {
    color: rgba(255, 255, 255, 0.78);
}

.profile-hero .rounded-4 strong {
    color: #FFFFFF;
    font-size: 1.02rem;
    overflow-wrap: anywhere;
}

/* =====================================================
   JARAK SECTION DAN JUDUL
   ===================================================== */

.section-space {
    padding: 76px 0;
}

.section-title {
    margin-bottom: 12px;
    color: var(--brand-dark);
    font-size: clamp(1.65rem, 3vw, 2.35rem);
    font-weight: 800;
    line-height: 1.3;
    letter-spacing: -0.6px;
}

.section-space .container > .mb-4 {
    margin-bottom: 30px !important;
}

.section-space .container > .mb-4 > .text-primary {
    color: var(--brand-primary) !important;
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1.8px;
}

.section-space .container > .mb-4 p {
    color: var(--brand-muted);
    line-height: 1.8;
}

.section-soft {
    background: #EDF7F5;
}

/* =====================================================
   KARTU IDENTITAS, KONTAK, DAN INFORMASI
   ===================================================== */

.profile-card {
    height: 100%;
    padding: 28px;
    overflow-wrap: anywhere;
    background: var(--brand-white);
    border: 1px solid var(--brand-border);
    border-radius: var(--brand-radius);
    box-shadow: var(--brand-shadow);
    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        border-color 0.25s ease;
}

.profile-card:hover {
    transform: translateY(-4px);
    border-color: rgba(16, 165, 150, 0.38);
    box-shadow: var(--brand-shadow-hover);
}

.profile-card > i {
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    margin-bottom: 20px !important;
    border-radius: 15px;
    background: var(--brand-light);
    color: var(--brand-primary);
    font-size: 1.45rem !important;
}

.profile-label {
    margin-bottom: 7px;
    color: var(--brand-muted);
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.2px;
}

.profile-value {
    color: var(--brand-text);
    font-size: 0.98rem;
    font-weight: 650;
    line-height: 1.7;
    overflow-wrap: anywhere;
}

.profile-card hr {
    margin: 22px 0;
    border-color: var(--brand-border);
    opacity: 1;
}

/* =====================================================
   STATISTIK SISWA, ALUMNI, DAN TENAGA PENDIDIK
   ===================================================== */

.stat-card {
    height: 100%;
    padding: 30px 18px;
    text-align: center;
    background: var(--brand-white);
    border: 1px solid var(--brand-border);
    border-radius: var(--brand-radius);
    box-shadow: var(--brand-shadow);
    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        border-color 0.25s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    border-color: rgba(16, 165, 150, 0.4);
    box-shadow: var(--brand-shadow-hover);
}

.stat-number {
    margin-bottom: 7px;
    color: var(--brand-primary);
    font-size: clamp(1.8rem, 3.5vw, 2.45rem);
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: -0.8px;
    overflow-wrap: anywhere;
}

.stat-label {
    color: var(--brand-muted);
    font-size: 0.88rem;
    font-weight: 600;
}

/* =====================================================
   VISI DAN MISI
   ===================================================== */

.vm-section {
    padding: 82px 0;
    background: var(--brand-background);
}

.vm-heading {
    margin-bottom: 34px;
    text-align: center;
}

.vm-eyebrow {
    color: var(--brand-dark);
    font-size: 0.76rem;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.vm-heading h2 {
    margin-top: 10px;
    color: var(--brand-dark);
    font-size: clamp(1.8rem, 4vw, 2.5rem);
    font-weight: 800;
    letter-spacing: -0.6px;
}

.vm-heading p {
    max-width: 760px;
    margin: 12px auto 0;
    color: var(--brand-muted);
    line-height: 1.9;
}

/* Kartu visi utama */
.vm-vision {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    padding: 48px 32px;
    color: #FFFFFF;
    text-align: center;
    background: linear-gradient(
        135deg,
        #087F74 0%,
        #10A596 60%,
        #21B5A5 100%
    );
    border: 1px solid rgba(16, 165, 150, 0.2);
    border-bottom: 5px solid #087F74;
    border-radius: 24px;
    box-shadow: 0 18px 42px rgba(16, 165, 150, 0.17);
}

.vm-vision::before,
.vm-vision::after {
    z-index: -1;
    border-color: rgba(255, 255, 255, 0.16);
    pointer-events: none;
}

.vm-vision-label {
    color: #D9FFF8;
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 3px;
}

.vm-vision h3 {
    max-width: 950px;
    margin: 20px auto;
    color: #FFFFFF;
    font-size: clamp(1.4rem, 3.5vw, 2.2rem);
    font-weight: 800;
    line-height: 1.6;
}

.vm-vision p {
    max-width: 800px;
    margin: 0 auto;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.9;
}

/* Kartu pilar dan misi */
.vm-card {
    height: 100%;
    padding: 26px;
    background: #FFFFFF;
    border: 1px solid var(--brand-border);
    border-radius: var(--brand-radius);
    box-shadow: var(--brand-shadow);
    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        border-color 0.25s ease;
}

.vm-card:hover {
    transform: translateY(-3px);
    border-color: rgba(16, 165, 150, 0.35);
    box-shadow: var(--brand-shadow-hover);
}

.vm-pillar-card {
    border-top: 4px solid var(--brand-primary);
}

.vm-letter {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    margin-bottom: 18px;
    border-radius: 15px;
    background: var(--brand-light);
    color: var(--brand-primary);
    font-size: 1.45rem;
    font-weight: 800;
}

.vm-card h3,
.vm-card h4 {
    color: var(--brand-dark);
    font-weight: 800;
}

.vm-card h4 {
    margin-bottom: 10px;
    font-size: 1.05rem;
}

.vm-card p,
.vm-card li {
    color: var(--brand-muted);
    font-size: 0.92rem;
    line-height: 1.85;
}

.vm-card ul {
    padding-left: 20px;
    margin-bottom: 0;
}

.vm-target {
    margin-top: 16px;
    padding-top: 15px;
    border-top: 1px solid var(--brand-border);
}

.vm-target strong {
    display: block;
    margin-bottom: 7px;
    color: var(--brand-dark);
    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.vm-mission-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
}

.vm-mission-card {
    display: flex;
    align-items: flex-start;
    gap: 18px;
    padding: 28px;
}

.vm-number {
    display: flex;
    flex: 0 0 46px;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    border-radius: 14px;
    background: var(--brand-primary);
    color: #FFFFFF;
    font-size: 0.95rem;
    font-weight: 800;
}

.vm-mission-card p {
    margin-bottom: 0;
}

.vm-pillar-tag {
    display: inline-block;
    margin-top: 14px;
    padding: 6px 12px;
    border: 1px solid rgba(16, 165, 150, 0.14);
    border-radius: 999px;
    background: var(--brand-light);
    color: var(--brand-dark);
    font-size: 0.74rem;
    font-weight: 750;
}

/* =====================================================
   TABEL STATISTIK
   ===================================================== */

.profile-table {
    overflow: hidden;
    background: #FFFFFF;
    border: 1px solid var(--brand-border);
    border-radius: var(--brand-radius);
    box-shadow: var(--brand-shadow) !important;
}

.profile-table .table {
    margin-bottom: 0;
    color: var(--brand-text);
    --bs-table-bg: #FFFFFF;
    --bs-table-color: var(--brand-text);
    --bs-table-hover-bg: #F1FAF8;
    --bs-border-color: var(--brand-border);
}

.profile-table .table thead th,
.profile-table .table-primary th {
    padding: 16px 14px;
    background: var(--brand-light) !important;
    color: var(--brand-dark) !important;
    border-color: var(--brand-border) !important;
    font-size: 0.84rem;
    font-weight: 800;
    white-space: nowrap;
}

.profile-table .table tbody th,
.profile-table .table tbody td {
    padding: 15px 14px;
    border-color: var(--brand-border);
    vertical-align: middle;
}

.profile-table .table tbody th {
    font-weight: 700;
}

.profile-table .table tbody tr:last-child > * {
    border-bottom: 0;
}

/* =====================================================
   TOMBOL DAN BADGE
   ===================================================== */

.btn {
    border-radius: 10px;
    font-weight: 700;
    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.btn-primary {
    background-color: var(--brand-primary);
    border-color: var(--brand-primary);
    color: #FFFFFF;
}

.btn-primary:hover,
.btn-primary:focus {
    background-color: var(--brand-primary-hover);
    border-color: var(--brand-primary-hover);
    color: #FFFFFF;
}

.btn-primary:active {
    background-color: var(--brand-dark) !important;
    border-color: var(--brand-dark) !important;
}

.btn-outline-primary {
    color: var(--brand-primary);
    border-color: var(--brand-primary);
}

.btn-outline-primary:hover {
    background: var(--brand-primary);
    border-color: var(--brand-primary);
    color: #FFFFFF;
}

.badge {
    font-weight: 700;
    letter-spacing: 0.15px;
}

/* =====================================================
   FOOTER
   ===================================================== */

.profile-footer {
    padding: 32px 0;
    background: #087F74;
    border-top: 4px solid var(--brand-primary);
    color: rgba(255, 255, 255, 0.9);
}

.profile-footer strong {
    color: #FFFFFF;
    font-size: 1rem;
    font-weight: 800;
}

.profile-footer a {
    color: #FFFFFF;
}

.profile-footer .small {
    color: rgba(255, 255, 255, 0.78);
}

/* =====================================================
   FOKUS, INPUT, DAN AKSESIBILITAS
   ===================================================== */

.form-control,
.form-select {
    border-color: var(--brand-border);
    border-radius: 10px;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--brand-primary);
    box-shadow: 0 0 0 0.2rem rgba(16, 165, 150, 0.15);
}

a:focus-visible,
button:focus-visible,
input:focus-visible,
select:focus-visible,
textarea:focus-visible {
    outline: 3px solid rgba(16, 165, 150, 0.55);
    outline-offset: 3px;
}

/* =====================================================
   RESPONSIVE TABLET
   ===================================================== */

@media (max-width: 1199.98px) {
    .vm-cinta-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .section-space,
    .vm-section {
        padding: 64px 0;
    }
}

/* =====================================================
   RESPONSIVE PONSEL
   ===================================================== */

@media (max-width: 767.98px) {
    .profile-hero {
        padding: 54px 0;
    }

    .profile-hero h1 {
        letter-spacing: -0.5px;
    }

    .section-space,
    .vm-section {
        padding: 48px 0;
    }

    .profile-card,
    .stat-card,
    .vm-card {
        border-radius: 15px;
    }

    .profile-card {
        padding: 22px;
    }

    .stat-card {
        padding: 24px 12px;
    }

    .vm-cinta-grid,
    .vm-mission-grid {
        grid-template-columns: 1fr;
    }

    .vm-vision {
        padding: 34px 20px;
        border-radius: 19px;
    }

    .vm-mission-card {
        gap: 14px;
        padding: 22px 18px;
    }

    .vm-number {
        flex-basis: 40px;
        width: 40px;
        height: 40px;
    }

    .profile-table .table thead th,
    .profile-table .table tbody th,
    .profile-table .table tbody td {
        padding: 12px 10px;
        font-size: 0.82rem;
    }
}

@media (max-width: 420px) {
    .profile-hero {
        padding: 44px 0;
    }

    .hero-label {
        font-size: 0.7rem;
        letter-spacing: 1.7px;
    }

    .profile-card {
        padding: 19px;
    }

    .vm-vision h3 {
        font-size: 1.35rem;
    }

    .vm-mission-card {
        padding: 19px 15px;
    }
}

/* =====================================================
   PENGATURAN ANIMASI
   ===================================================== */

@media (prefers-reduced-motion: reduce) {
    html {
        scroll-behavior: auto;
    }

    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* KEPALA MADRASAH */
.principal-card {
    display: flex;
    align-items: center;
    gap: 38px;
    max-width: 900px;
    margin: 0 auto;
    padding: 32px;
    background: #FFFFFF;
    border: 1px solid var(--brand-border);
    border-radius: 22px;
    box-shadow: var(--brand-shadow);
}

.principal-photo-wrapper {
    flex: 0 0 220px;
}

.principal-photo {
    display: block;
    width: 220px;
    height: 270px;
    object-fit: cover;
    object-position: center;
    border-radius: 16px;
    border: 4px solid var(--brand-light);
}

.principal-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 220px;
    height: 270px;
    border-radius: 16px;
    background: var(--brand-light);
    color: var(--brand-primary);
    font-size: 5rem;
}

.principal-content {
    flex: 1;
}

.principal-label {
    color: var(--brand-primary);
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1.8px;
}

.principal-content h3 {
    margin: 12px 0;
    color: var(--brand-dark);
    font-size: 1.8rem;
    font-weight: 800;
}

.principal-period {
    color: var(--brand-muted);
}

.principal-quote {
    position: relative;
    margin-top: 24px;
    padding: 20px 22px;
    background: var(--brand-light);
    border-left: 4px solid var(--brand-primary);
    border-radius: 12px;
}

.principal-quote i {
    color: var(--brand-primary);
    font-size: 1.8rem;
}

.principal-quote p {
    margin: 8px 0 0;
    color: var(--brand-text);
    font-style: italic;
    line-height: 1.8;
}

@media (max-width: 767.98px) {
    .principal-card {
        flex-direction: column;
        gap: 24px;
        padding: 22px;
        text-align: center;
    }

    .principal-photo-wrapper {
        flex-basis: auto;
    }

    .principal-photo,
    .principal-placeholder {
        width: 180px;
        height: 220px;
    }

    .principal-content h3 {
        font-size: 1.4rem;
    }
}

    </style>
</head>

<body>

{{-- Navbar publik yang sudah kamu buat --}}
@include('layouts.navigation')

{{-- HERO --}}
<header class="profile-hero">
    <div class="container position-relative" style="z-index:1">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <div class="hero-label mb-3">PROFIL RESMI MADRASAH</div>

                <h1 class="mb-3">
                    {{ $profile->name ?: 'MA Miftahul Midad' }}
                </h1>

                <p class="lead mb-4">
                    Mengenal identitas, informasi, dan perkembangan
                    MA Miftahul Midad.
                </p>

                @if($profile->accreditation)
                    <span class="badge rounded-pill bg-light text-primary px-3 py-2">
                        Akreditasi {{ $profile->accreditation }}
                    </span>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="p-4 rounded-4 border border-light border-opacity-25"
                     style="background:rgba(255,255,255,.1)">
                    <div class="small mb-3 text-uppercase"
                         style="color:#bfdbfe;letter-spacing:1px">
                        Identitas Lembaga
                    </div>

                    <div class="mb-3">
                        <div class="small opacity-75">NSM</div>
                        <strong>{{ $profile->nsm ?: 'Belum diisi' }}</strong>
                    </div>

                    <div>
                        <div class="small opacity-75">NPSN</div>
                        <strong>{{ $profile->npsn ?: 'Belum diisi' }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- IDENTITAS --}}
<section class="section-space">
    <div class="container">
        <div class="mb-4">
            <div class="text-primary fw-bold small mb-2">TENTANG MADRASAH</div>
            <h2 class="section-title">Identitas Madrasah</h2>
            <p class="text-secondary">
                Informasi resmi MA Miftahul Midad.
            </p>
        </div>

        @php
            $identity = [
                'Nomor Statistik Madrasah' => $profile->nsm,
                'NPSN' => $profile->npsn,
                'Nomor Piagam Pendirian' => $profile->establishment_charter,
                'Izin Operasional' => $profile->operational_license,
                'Tanggal/Tahun Berdiri' => $profile->founded_at,
                'Akreditasi' => $profile->accreditation,
                'Yayasan' => $profile->foundation,
                'Tahun Ajaran' => $profile->academic_year,
            ];
        @endphp

        <div class="row g-3">
            @foreach($identity as $label => $value)
                @if(filled($value))
                    <div class="col-sm-6 col-lg-3">
                        <div class="profile-card">
                            <i class="bi bi-building mb-3 d-block"></i>
                            <div class="profile-label">{{ $label }}</div>
                            <div class="profile-value">{{ $value }}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

{{-- VISI DAN MISI MADRASAH --}}
@php
    $visionText = filled($profile->vision ?? null)
        ? $profile->vision
        : 'Terwujudnya generasi yang Cerdas, Islami, Nyaman, Tangguh, dan Adaptif (CINTA) berlandaskan Nilai Kepesantrenan dan Berdaya Saing Global';

    $missionText = trim((string) ($profile->mission ?? ''));

    // Setiap misi yang ditulis pada baris baru di halaman admin
    // akan ditampilkan sebagai kartu terpisah.
    $missionItems = collect(preg_split('/\r\n|\r|\n/', $missionText))
        ->map(fn ($item) => trim($item))
        ->filter()
        ->values();

    $missionPillars = [
        'Pilar Cerdas',
        'Pilar Islami',
        'Pilar Nyaman',
        'Pilar Tangguh & Adaptif',
    ];
@endphp

<section class="vm-section">
    <div class="container">

        <div class="vm-heading">
            <span class="vm-eyebrow">Arah dan Tujuan Madrasah</span>
            <h2>Visi dan Misi Madrasah</h2>
            <p>
                Landasan penyelenggaraan pendidikan MA Miftahul Midad
                untuk membentuk generasi berkarakter, berlandaskan nilai
                kepesantrenan, dan berdaya saing global.
            </p>
        </div>

        {{-- VISI UTAMA: DIAMBIL DARI MENU ADMIN --}}
        <div class="vm-vision">
            <div class="vm-vision-label">VISI MADRASAH</div>
            <h3>{{ $visionText }}</h3>
            <p>
                Cerdas, Islami, Nyaman, Tangguh, dan Adaptif (CINTA)
                berlandaskan nilai kepesantrenan.
            </p>
        </div>

        {{-- MISI: DINAMIS DARI INPUT ADMIN --}}
        <div class="vm-heading">
            <span class="vm-eyebrow">Langkah Strategis</span>
            <h2>Misi Madrasah</h2>
            <p>
                Misi yang ditetapkan untuk mewujudkan visi
                MA Miftahul Midad.
            </p>
        </div>

        @if ($missionItems->isNotEmpty())
            <div class="vm-mission-grid">
                @foreach ($missionItems as $index => $missionItem)
                    @php
                        // Hapus nomor di awal teks, misalnya "1." atau "1)".
                        $missionContent = preg_replace(
                            '/^\s*(?:\d+[\.\)]|[-•])\s*/u',
                            '',
                            $missionItem
                        );
                    @endphp

                    <article class="vm-card vm-mission-card">
                        <div class="vm-number">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div>
                            <h4>Misi {{ $index + 1 }}</h4>
                            <p>{{ $missionContent }}</p>

                            @if (isset($missionPillars[$index]))
                                <span class="vm-pillar-tag">
                                    {{ $missionPillars[$index] }}
                                </span>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="vm-card text-center">
                <i class="bi bi-pencil-square mb-3 d-block"
                   style="font-size:2rem;color:#176b45"></i>
                <h4>Misi Madrasah Belum Diisi</h4>
                <p class="mb-0">
                    Silakan isi misi melalui menu Admin &gt; Profil Lembaga.
                </p>
            </div>
        @endif

    </div>
</section>

{{-- ALAMAT DAN KONTAK --}}
<section class="section-space section-soft">
    <div class="container">
        <div class="mb-4">
            <div class="text-primary fw-bold small mb-2">LOKASI DAN KOMUNIKASI</div>
            <h2 class="section-title">Alamat dan Kontak</h2>
        </div>

        <div class="row g-3">
            <div class="col-lg-6">
                <div class="profile-card">
                    <i class="bi bi-geo-alt mb-3 d-block"></i>
                    <div class="profile-label">Alamat Lengkap</div>
                    <div class="profile-value">
                        {{ $profile->address ?: 'Belum diisi' }}
                    </div>

                    <hr>

                    <div class="profile-label">Wilayah</div>
                    <div class="profile-value">
                        {{ collect([
                            $profile->village,
                            $profile->district,
                            $profile->regency,
                            $profile->province,
                            $profile->postal_code
                        ])->filter()->implode(', ') ?: 'Belum diisi' }}
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="profile-card">
                    <i class="bi bi-envelope mb-3 d-block"></i>

                    <div class="profile-label">Email</div>
                    <div class="profile-value">
                        @if($profile->email)
                            <a href="mailto:{{ $profile->email }}">
                                {{ $profile->email }}
                            </a>
                        @else
                            Belum diisi
                        @endif
                    </div>

                    <hr>

                    <div class="profile-label">Nomor Telepon</div>
                    <div class="profile-value">
                        {{ $profile->phone ?: 'Belum diisi' }}
                    </div>

                    <hr>

                    <div class="profile-label">Website</div>
                    <div class="profile-value">
                        @if($profile->website)
                            <a href="{{ \Illuminate\Support\Str::startsWith($profile->website, ['https://', 'http://']) ? $profile->website : 'https://'.$profile->website }}"
                               target="_blank" rel="noopener">
                                {{ $profile->website }}
                            </a>
                        @else
                            Belum diisi
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- DATA SISWA --}}
<section class="section-space">
    <div class="container">
        <div class="mb-4">
            <div class="text-primary fw-bold small mb-2">DATA AKADEMIK</div>
            <h2 class="section-title">Statistik Siswa</h2>
            <p class="text-secondary">
                Data siswa berdasarkan tingkat kelas.
            </p>
        </div>

        @php
            $totalX = (int)$profile->class_x_male + (int)$profile->class_x_female;
            $totalXI = (int)$profile->class_xi_male + (int)$profile->class_xi_female;
            $totalXII = (int)$profile->class_xii_male + (int)$profile->class_xii_female;
            $totalStudents = $totalX + $totalXI + $totalXII;
        @endphp

        <div class="row g-3 mb-4">
            @foreach([
                'Kelas X' => $totalX,
                'Kelas XI' => $totalXI,
                'Kelas XII' => $totalXII,
                'Total Siswa' => $totalStudents,
            ] as $label => $number)
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-number">
                            {{ number_format($number, 0, ',', '.') }}
                        </div>
                        <div class="stat-label">{{ $label }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="table-responsive profile-table shadow-sm">
            <table class="table table-bordered table-hover align-middle text-center mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>Tingkat</th>
                        <th>Laki-laki</th>
                        <th>Perempuan</th>
                        <th>Total</th>
                        <th>Rombel</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([
                        ['Kelas X', $profile->class_x_male, $profile->class_x_female, $profile->class_x_rombel],
                        ['Kelas XI', $profile->class_xi_male, $profile->class_xi_female, $profile->class_xi_rombel],
                        ['Kelas XII', $profile->class_xii_male, $profile->class_xii_female, $profile->class_xii_rombel],
                    ] as $row)
                        <tr>
                            <th>{{ $row[0] }}</th>
                            <td>{{ number_format((int)$row[1], 0, ',', '.') }}</td>
                            <td>{{ number_format((int)$row[2], 0, ',', '.') }}</td>
                            <td>{{ number_format((int)$row[1] + (int)$row[2], 0, ',', '.') }}</td>
                            <td>{{ number_format((int)$row[3], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- ALUMNI --}}
<section class="section-space section-soft">
    <div class="container">
        <div class="mb-4">
            <div class="text-primary fw-bold small mb-2">LULUSAN</div>
            <h2 class="section-title">Data Alumni</h2>

            @if($profile->alumni_year)
                <p class="text-secondary">
                    Tahun data alumni: {{ $profile->alumni_year }}
                </p>
            @endif
        </div>

        <div class="row g-3">
            @foreach([
                'Alumni Laki-laki' => $profile->alumni_male,
                'Alumni Perempuan' => $profile->alumni_female,
                'Total Alumni' => (int)$profile->alumni_male + (int)$profile->alumni_female,
            ] as $label => $number)
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-number">
                            {{ number_format((int)$number, 0, ',', '.') }}
                        </div>
                        <div class="stat-label">{{ $label }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- TENAGA PENDIDIK --}}
<section class="section-space">
    <div class="container">
        <div class="mb-4">
            <div class="text-primary fw-bold small mb-2">SUMBER DAYA MANUSIA</div>
            <h2 class="section-title">Tenaga Pendidik dan Kependidikan</h2>
            <p class="text-secondary">
                Jumlah tenaga pendidik berdasarkan jenjang pendidikan.
            </p>
        </div>

        <div class="row g-3">
            @foreach([
                'SMU/SMA' => $profile->staff_smu,
                'Diploma 3 (D3)' => $profile->staff_d3,
                'Sarjana (S1)' => $profile->staff_s1,
                'Magister (S2)' => $profile->staff_s2,
                'Doktor (S3)' => $profile->staff_s3,
            ] as $label => $number)
                <div class="col-6 col-lg">
                    <div class="stat-card">
                        <div class="stat-number">
                            {{ number_format((int)$number, 0, ',', '.') }}
                        </div>
                        <div class="stat-label">{{ $label }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- KEPALA MADRASAH --}}
<section class="section-space section-soft">
    <div class="container">

        <div class="vm-heading">
            <span class="vm-eyebrow">KEPEMIMPINAN</span>
            <h2>Kepala Madrasah</h2>
            <p>
                Pimpinan MA Miftahul Midad dalam mengembangkan pendidikan
                yang berlandaskan nilai kepesantrenan.
            </p>
        </div>

        <div class="principal-card">
            <div class="principal-photo-wrapper">
                @if(!empty($profile->principal_photo))
                    <img
                        src="{{ asset('storage/' . $profile->principal_photo) }}"
                        alt="Foto {{ $profile->principal_name }}"
                        class="principal-photo"
                    >
                @else
                    <div class="principal-placeholder">
                        <i class="bi bi-person-fill"></i>
                    </div>
                @endif
            </div>

            <div class="principal-content">
                <span class="principal-label">
                    KEPALA MA MIFTAHUL MIDAD
                </span>

                <h3>
                    {{ $profile->principal_name ?: 'Nama Kepala Madrasah Belum Diisi' }}
                </h3>

                @if($profile->principal_period)
                    <p class="principal-period">
                        <i class="bi bi-calendar3 me-2"></i>
                        Periode jabatan: {{ $profile->principal_period }}
                    </p>
                @endif

                @if($profile->principal_quote)
                    <div class="principal-quote">
                        <i class="bi bi-quote"></i>
                        <p>{{ $profile->principal_quote }}</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>

{{-- FOOTER --}}
@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
