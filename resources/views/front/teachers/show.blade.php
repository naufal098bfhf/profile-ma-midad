@extends('layouts.app')

@section('title', $teacher->name)

@section('content')

<!-- Custom Style untuk Detail Profil Guru (Sesuai Referensi UI) -->
<style>
    /* Latar Belakang & Header Melengkung */
    .profile-page-wrapper {
        background-color: #f8fafc;
        min-height: 100vh;
        padding-bottom: 5rem;
        position: relative;
    }

    .curved-blue-header {
        background: linear-gradient(135deg, #0a192f 0%, #1e3a8a 50%, #1d4ed8 100%);
        height: 280px;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        border-bottom-left-radius: 50% 10%;
        border-bottom-right-radius: 50% 10%;
        z-index: 1;
    }

    /* Breadcrumb Navigasi */
    .custom-breadcrumb {
        position: relative;
        z-index: 2;
        padding-top: 1.5rem;
        margin-bottom: 1.5rem;
        color: #ffffff;
        font-size: 0.875rem;
    }

    .custom-breadcrumb a {
        color: #93c5fd;
        text-decoration: none;
        transition: color 0.2s;
    }

    .custom-breadcrumb a:hover {
        color: #ffffff;
    }

    .custom-breadcrumb .separator {
        margin: 0 0.5rem;
        color: #60a5fa;
    }

    /* Kartu Utama Profil (White Card) */
    .profile-main-card {
        position: relative;
        z-index: 2;
        background: #ffffff;
        border-radius: 28px;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.07);
        border: 1px solid rgba(226, 232, 240, 0.8);
        padding: 2.5rem;
        margin-bottom: 4rem;
    }

    /* Foto & Badge Guru Aktif */
    .profile-photo-container {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(29, 78, 216, 0.25);
        height: 100%;
        min-height: 320px;
        background: #e2e8f0;
    }

    .profile-photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
    }

    .badge-status-active {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: #1d4ed8;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.5rem 1.25rem;
        border-radius: 50rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Teks & Ornamen Judul Profil */
    .profile-name {
        color: #0f172a;
        font-size: 2.5rem;
        font-weight: 700;
        font-family: 'Georgia', 'Times New Roman', serif;
        margin-bottom: 0.25rem;
    }

    .profile-role-subtitle {
        color: #2563eb;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .ornament-divider {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 2rem;
    }

    .ornament-divider .line {
        height: 2px;
        width: 40px;
        background: #93c5fd;
        border-radius: 2px;
    }

    .ornament-divider .dot {
        width: 6px;
        height: 6px;
        background: #2563eb;
        border-radius: 50%;
    }

    /* Grid Informasi Profil (2 Kolom dengan Ikon Bulat Biru) */
    .info-grid-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.75rem;
    }

    .info-icon-box {
        width: 46px;
        height: 46px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        flex-shrink: 0;
    }

    .info-label {
        color: #0f172a;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 2px;
    }

    .info-value {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
    }

    /* Bagian Guru Lainnya */
    .other-teachers-title {
        color: #0f172a;
        font-size: 1.75rem;
        font-weight: 700;
        font-family: 'Georgia', 'Times New Roman', serif;
        text-align: center;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .other-teachers-title .ornament-gold {
        color: #d97706;
        font-size: 0.85rem;
    }

    .other-teacher-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .other-teacher-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 25px -5px rgba(15, 23, 42, 0.08);
        border-color: #93c5fd;
    }

    .other-teacher-card img {
        height: 200px;
        width: 100%;
        object-fit: cover;
        object-position: top center;
    }

    .other-teacher-card .card-body {
        padding: 1.25rem 1rem 0.5rem;
    }

    .other-teacher-card h6 {
        color: #0f172a;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .other-teacher-card p {
        color: #64748b;
        font-size: 0.8rem;
        margin-bottom: 1rem;
    }

    .btn-profile-link {
        color: #2563eb;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: gap 0.2s;
    }

    .other-teacher-card:hover .btn-profile-link {
        color: #1d4ed8;
        gap: 8px;
    }

    /* Banner Bawah (Blue Footer Banner) */
    .bottom-features-banner {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        border-radius: 24px;
        padding: 2.5rem 2rem;
        margin-top: 4rem;
        color: #ffffff;
        box-shadow: 0 15px 30px -5px rgba(30, 58, 138, 0.3);
    }

    .feature-box {
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .feature-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #ffffff;
        flex-shrink: 0;
    }

    .feature-title {
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: 2px;
        color: #ffffff;
    }

    .feature-desc {
        font-size: 0.8rem;
        color: #bfdbfe;
        line-height: 1.4;
        margin: 0;
    }
</style>

<div class="profile-page-wrapper">
    <!-- Header Biru Melengkung -->
    <div class="curved-blue-header"></div>

    <div class="container">
        <!-- Breadcrumb -->
        <div class="custom-breadcrumb d-flex align-items-center">
            <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Beranda</a>
            <span class="separator">›</span>
            <a href="{{ url('/teachers') }}">Guru</a>
            <span class="separator">›</span>
            <span class="text-white fw-semibold">Profil Guru</span>
        </div>

        <!-- Kartu Utama Profil -->
        <div class="profile-main-card">
            <div class="row g-4 align-items-center">
                <!-- Kolom Kiri: Foto Guru -->
                <div class="col-lg-5">
                    <div class="profile-photo-container">
                        <img src="{{ $teacher->photo_url }}" alt="{{ $teacher->name }}">
                        <div class="badge-status-active">
                            <i class="fas fa-user"></i> Guru Aktif
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Detail Informasi -->
                <div class="col-lg-7 ps-lg-4">
                    <h1 class="profile-name">{{ $teacher->name }}</h1>
                    <div class="profile-role-subtitle">Guru {{ $teacher->subject }}</div>

                    <!-- Ornamen Pemisah -->
                    <div class="ornament-divider">
                        <span class="line"></span>
                        <span class="dot"></span>
                        <span class="line"></span>
                    </div>

                    <!-- Grid Informasi -->
                    <div class="row">
                        <!-- Kolom Kiri Grid -->
                        <div class="col-md-6">
                            <div class="info-grid-item">
                                <div class="info-icon-box">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div>
                                    <div class="info-label">Jabatan</div>
                                    <p class="info-value">{{ $teacher->position }}</p>
                                </div>
                            </div>

                            <div class="info-grid-item">
                                <div class="info-icon-box">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div>
                                    <div class="info-label">Mata Pelajaran</div>
                                    <p class="info-value">{{ $teacher->subject }}</p>
                                </div>
                            </div>

                            <div class="info-grid-item">
                                <div class="info-icon-box">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div>
                                    <div class="info-label">Pendidikan</div>
                                    <p class="info-value">{{ $teacher->education }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan Grid -->
                        <div class="col-md-6">
                            <div class="info-grid-item">
                                <div class="info-icon-box">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <div class="info-label">Email</div>
                                    <p class="info-value">{{ $teacher->email }}</p>
                                </div>
                            </div>

                            <div class="info-grid-item">
                                <div class="info-icon-box">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <div class="info-label">No. HP</div>
                                    <p class="info-value">{{ $teacher->phone }}</p>
                                </div>
                            </div>

                            <div class="info-grid-item">
                                <div class="info-icon-box">
                                    <i class="fas fa-comment-dots"></i>
                                </div>
                                <div>
                                    <div class="info-label">Deskripsi</div>
                                    <p class="info-value">
                                        {!! nl2br(e($teacher->description)) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Seksi Guru Lainnya -->
        @if($otherTeachers->count())
            <div class="mt-5">
                <h3 class="other-teachers-title">
                    <span class="ornament-gold">◆ —</span>
                    Guru Lainnya
                    <span class="ornament-gold">— ◆</span>
                </h3>

                <div class="row d-flex align-items-stretch">
                    @foreach($otherTeachers as $item)
                        <div class="col-lg-3 col-md-6 mb-4 d-flex">
                            <div class="other-teacher-card w-100">
                                <div>
                                    <img src="{{ $item->photo_url }}" alt="{{ $item->name }}">
                                    <div class="card-body text-center">
                                        <h6>{{ $item->name }}</h6>
                                        <p>{{ $item->subject }}</p>
                                    </div>
                                </div>
                                <div class="pb-3 text-center">
                                    <a href="{{ route('teachers.show', $item->id) }}" class="btn-profile-link">
                                        Lihat Profil <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Banner Fitur Bawah (Sesuai Referensi UI) -->
        <div class="bottom-features-banner">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <div class="feature-title">Guru Profesional</div>
                            <div class="feature-desc">Tenaga pendidik berkompeten dan berpengalaman</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div>
                            <div class="feature-title">Dedikasi Tinggi</div>
                            <div class="feature-desc">Mengabdi dengan sepenuh hati untuk pendidikan Islami</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <div class="feature-title">Berprestasi</div>
                            <div class="feature-desc">Mendorong siswa meraih prestasi akademik dan non akademik</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div>
                            <div class="feature-title">Islami & Berkarakter</div>
                            <div class="feature-desc">Membentuk generasi yang unggul dalam ilmu dan akhlak</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
