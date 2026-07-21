<!-- Custom Style untuk Teacher Widget (Sesuai Referensi UI) -->
<style>
    /* Section Background & Container */
    .teacher-widget-premium {
        background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 50%, #f1f5f9 100%);
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }

    /* Header Styling */
    .teacher-widget-premium .widget-tag {
        color: #1e40af;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .teacher-widget-premium .widget-main-title {
        color: #0f172a;
        font-size: 2.35rem;
        font-weight: 700;
        font-family: 'Georgia', 'Times New Roman', serif;
        line-height: 1.25;
        margin-bottom: 0.5rem;
    }

    /* Ornamen Garis Emas di Bawah Judul */
    .teacher-widget-premium .title-ornament {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 1.25rem 0;
    }
    .teacher-widget-premium .title-ornament .line-long {
        height: 2px;
        width: 120px;
        background: #d97706;
        border-radius: 2px;
    }
    .teacher-widget-premium .title-ornament .diamond {
        color: #d97706;
        font-size: 0.75rem;
        line-height: 1;
    }
    .teacher-widget-premium .title-ornament .line-short {
        height: 2px;
        width: 40px;
        background: #d97706;
        border-radius: 2px;
    }

    .teacher-widget-premium .widget-desc {
        color: #475569;
        font-size: 0.95rem;
        line-height: 1.6;
        max-width: 500px;
    }

    /* Tombol Lihat Semua (Dark Navy Pill) */
    .teacher-widget-premium .btn-view-all {
        background: #0f172a;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.75rem 1.75rem;
        border-radius: 50rem;
        box-shadow: 0 10px 20px -5px rgba(15, 23, 42, 0.4);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        border: none;
    }

    .teacher-widget-premium .btn-view-all:hover {
        background: #1e3a8a;
        box-shadow: 0 15px 25px -5px rgba(30, 58, 138, 0.5);
        transform: translateY(-2px);
    }

    /* Desain Kartu Guru */
    .teacher-widget-premium .teacher-card {
        background: #ffffff;
        border-radius: 24px !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
    }

    .teacher-widget-premium .teacher-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px -5px rgba(15, 23, 42, 0.1), 0 10px 15px -5px rgba(15, 23, 42, 0.04);
        border-color: #93c5fd !important;
    }

    /* Foto & Overlay Gradasi Biru */
   /* Perbaikan: Ganti background agar putih bersih, bukan biru */
.teacher-widget-premium .img-container {
    position: relative;
    height: 280px;
    overflow: hidden;
    border-radius: 24px 24px 0 0;
    background: #ffffff; /* Ubah dari #e2e8f0 ke putih */
    border-bottom: 1px solid #f1f5f9; /* Tambahkan border agar rapi */
}

/* Memastikan gambar tetap tertata */
.teacher-widget-premium .img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    transition: transform 0.6s ease;
    display: block;
}

    .teacher-widget-premium .teacher-card:hover .img-container img {
        transform: scale(1.06);
    }

    .teacher-widget-premium .img-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 65%;
        background: linear-gradient(to top, rgba(10, 25, 47, 0.95) 0%, rgba(10, 25, 47, 0.4) 50%, transparent 100%);
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 1rem;
    }

    /* Badge & Icon di Dalam Foto */
    .teacher-widget-premium .btn-icon-top {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #1d4ed8;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 2;
    }

    .teacher-widget-premium .subject-pill {
        background: rgba(29, 78, 216, 0.85);
        backdrop-filter: blur(4px);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.35rem 1rem;
        border-radius: 50rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        z-index: 2;
    }

    /* Detail Teks Kartu */
    .teacher-widget-premium .teacher-name {
        color: #0f172a;
        font-size: 1.05rem;
        font-weight: 700;
        font-family: 'Georgia', 'Times New Roman', serif;
        margin-bottom: 0.25rem;
    }

    .teacher-widget-premium .teacher-position {
        color: #2563eb;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .teacher-widget-premium .teacher-subject-detail {
        color: #64748b;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-bottom: 1.25rem;
    }

    /* Tombol Lihat Profil (Outline Pill) */
    .teacher-widget-premium .btn-profile-outline {
        border: 1.5px solid #93c5fd;
        color: #1e40af;
        background: transparent;
        border-radius: 50rem;
        padding: 0.5rem 1.25rem;
        font-size: 0.85rem;
        font-weight: 600;
        width: 85%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .teacher-widget-premium .teacher-card:hover .btn-profile-outline,
    .teacher-widget-premium .btn-profile-outline:hover {
        background: #1e40af;
        color: #ffffff !important;
        border-color: #1e40af;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);
    }

    /* Banner Statistik Bawah (Persis Referensi) */
    .teacher-widget-premium .stats-banner {
        background: #ffffff;
        border-radius: 24px;
        padding: 0.5rem 1.5rem;
        margin-top: 1rem;
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.03);
    }

    .teacher-widget-premium .stat-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .teacher-widget-premium .stat-icon {
        width: 54px;
        height: 54px;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .teacher-widget-premium .stat-title {
        color: #0f172a;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .teacher-widget-premium .stat-desc {
        color: #64748b;
        font-size: 0.75rem;
        line-height: 1.4;
        margin: 0;
    }

    /* Empty State */
    .teacher-widget-premium .empty-state {
        background: #ffffff;
        border-radius: 24px;
        border: 2px dashed #cbd5e1;
        padding: 4rem 1rem;
    }
</style>

<section class="teacher-widget-premium">
    <div class="container">
        <!-- Widget Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-start mb-5 gap-4">
            <div>
                <div class="widget-tag">
                    <i class="fas fa-users"></i> TENAGA PENDIDIK
                </div>

                <h2 class="widget-main-title">
                    Guru Profesional<br>MA Miftahul Midad
                </h2>

                <!-- Ornamen Emas -->
                <div class="title-ornament">
                    <span class="line-long"></span>
                    <span class="diamond">◆</span>
                    <span class="line-short"></span>
                </div>

                <p class="widget-desc mb-0">
                    Guru-guru terbaik yang berdedikasi dalam membentuk generasi Islami, berprestasi dan berkarakter.
                </p>
            </div>

            <div class="align-self-start align-self-md-center mt-2 mt-md-0">
                <a href="{{ route('teachers.index') }}" class="btn-view-all">
                    Lihat Semua Guru <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Teacher Cards Grid -->
        <div class="row d-flex align-items-stretch">
            @forelse($teachers as $teacher)
                <div class="col-lg-3 col-md-6 mb-4 d-flex">
                    <div class="card teacher-card border-0 w-100 d-flex flex-column justify-content-between">
                        <div>
                            <!-- Foto dengan Overlay Gradasi & Badges -->
                            <div class="img-container">
    <img src="{{ $teacher->photo_url }}"
         alt="{{ $teacher->name }}"
         onerror="this.style.display='none';">
                                <div class="btn-icon-top">
                                    <i class="fas fa-user"></i>
                                </div>

                                <div class="img-overlay">
                                    <div class="subject-pill">
                                        <i class="fas fa-book-open"></i> {{ $teacher->subject }}
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Guru -->
                            <div class="card-body text-center pt-3 pb-0 px-2">
                                <h5 class="teacher-name">
                                    {{ $teacher->name }}
                                </h5>

                                <div class="teacher-position">
                                    {{ $teacher->position }}
                                </div>

                                <div class="teacher-subject-detail">
                                    <i class="fas fa-book me-1 text-secondary"></i> {{ $teacher->subject }}
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer / Tombol Lihat Profil -->
                        <div class="card-footer bg-white border-0 pb-4 pt-1 text-center">
                            <a href="{{ route('teachers.show', ['teacher' => $teacher->id]) }}" class="btn-profile-outline">
                                Lihat Profil <i class="fas fa-arrow-right" style="font-size: 0.75rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state text-center">
                        <i class="fas fa-user-tie fa-3x text-secondary opacity-50 mb-3"></i>
                        <h6 class="fw-bold text-dark mb-1">Belum ada data guru.</h6>
                        <p class="text-muted mb-0 small">Daftar guru profesional sedang dalam proses perbaruan sistem.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Banner Statistik Tambahan (Menyempurnakan Tampilan Persis Referensi) -->
        <div class="stats-banner">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <div class="stat-title">25+</div>
                            <div class="stat-desc fw-semibold text-dark">Guru Profesional</div>
                            <div class="stat-desc">Tenaga pendidik berkompeten di bidangnya</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <div class="stat-title">10+</div>
                            <div class="stat-desc fw-semibold text-dark">Mata Pelajaran</div>
                            <div class="stat-desc">Berbagai mata pelajaran untuk pengembangan potensi siswa</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div>
                            <div class="stat-title">100%</div>
                            <div class="stat-desc fw-semibold text-dark">Dedikasi Penuh</div>
                            <div class="stat-desc">Komitmen penuh dalam mendidik generasi terbaik</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div>
                            <div class="stat-title" style="font-size: 1rem; color: #1e40af;">Islami & Berkarakter</div>
                            <div class="stat-desc">Membentuk generasi yang berakhlak mulia dan berprestasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
