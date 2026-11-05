<!-- Custom Style untuk Teacher Widget (Sesuai Referensi UI) -->
<style>
    /* =====================================================
       MA MIFTAHUL MIDAD — WIDGET GURU
       Tema Turquoise: #10A596
       CSS only; struktur Blade dan data tetap dipertahankan
       ===================================================== */

    .teacher-widget-premium {
        --teacher-primary: #10A596;
        --teacher-hover: #0D8176;
        --teacher-dark: #087F74;
        --teacher-light: #E7F7F4;
        --teacher-bg: #F7FBFA;
        --teacher-text: #243746;
        --teacher-muted: #64748B;
        --teacher-border: #DCEBE8;

        background: linear-gradient(135deg, #F7FBFA 0%, #EDF8F6 52%, #F7FBFA 100%);
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
        color: var(--teacher-text);
    }

    .teacher-widget-premium .widget-tag {
        color: var(--teacher-dark);
        font-size: .8rem;
        font-weight: 800;
        letter-spacing: .13em;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: .75rem;
    }

    .teacher-widget-premium .widget-tag i {
        color: var(--teacher-primary);
    }

    .teacher-widget-premium .widget-main-title {
        color: var(--teacher-text);
        font-size: clamp(1.8rem, 3.5vw, 2.45rem);
        font-weight: 800;
        font-family: "Inter", "Segoe UI", Arial, sans-serif;
        line-height: 1.25;
        letter-spacing: -.7px;
        margin-bottom: .5rem;
    }

    .teacher-widget-premium .title-ornament {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 1.15rem 0;
    }

    .teacher-widget-premium .title-ornament .line-long,
    .teacher-widget-premium .title-ornament .line-short {
        height: 3px;
        background: var(--teacher-primary);
        border-radius: 3px;
    }

    .teacher-widget-premium .title-ornament .line-long {
        width: 90px;
    }

    .teacher-widget-premium .title-ornament .diamond {
        color: var(--teacher-primary);
        font-size: .7rem;
        line-height: 1;
    }

    .teacher-widget-premium .title-ornament .line-short {
        width: 34px;
    }

    .teacher-widget-premium .widget-desc {
        color: var(--teacher-muted);
        font-size: .95rem;
        line-height: 1.85;
        max-width: 520px;
    }

    .teacher-widget-premium .btn-view-all {
        background: var(--teacher-primary);
        color: #FFFFFF !important;
        font-weight: 700;
        font-size: .9rem;
        padding: .8rem 1.6rem;
        border-radius: 50rem;
        border: 1px solid var(--teacher-primary);
        box-shadow: 0 8px 20px rgba(16, 165, 150, .2);
        transition: background .25s ease, box-shadow .25s ease, transform .25s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        text-decoration: none;
    }

    .teacher-widget-premium .btn-view-all:hover {
        background: var(--teacher-hover);
        border-color: var(--teacher-hover);
        color: #FFFFFF !important;
        box-shadow: 0 12px 26px rgba(16, 165, 150, .25);
        transform: translateY(-2px);
    }

    .teacher-widget-premium .teacher-card {
        background: #FFFFFF;
        border-radius: 20px !important;
        border: 1px solid var(--teacher-border) !important;
        box-shadow: 0 8px 25px rgba(36, 55, 70, .055);
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        overflow: hidden;
    }

    .teacher-widget-premium .teacher-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 34px rgba(16, 165, 150, .13);
        border-color: rgba(16, 165, 150, .45) !important;
    }

    .teacher-widget-premium .img-container {
        position: relative;
        height: 280px;
        overflow: hidden;
        border-radius: 19px 19px 0 0;
        background: #F1F8F6;
        border-bottom: 1px solid var(--teacher-border);
    }

    .teacher-widget-premium .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
        transition: transform .5s ease;
        display: block;
    }

    .teacher-widget-premium .teacher-card:hover .img-container img {
        transform: scale(1.04);
    }

    .teacher-widget-premium .img-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 65%;
        background: linear-gradient(
            to top,
            rgba(8, 55, 51, .90) 0%,
            rgba(8, 55, 51, .42) 48%,
            transparent 100%
        );
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 1rem;
    }

    .teacher-widget-premium .btn-icon-top {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 38px;
        height: 38px;
        border: 1px solid rgba(255, 255, 255, .5);
        border-radius: 50%;
        background: var(--teacher-primary);
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
        box-shadow: 0 5px 15px rgba(8, 55, 51, .2);
        z-index: 2;
    }

    .teacher-widget-premium .subject-pill {
        background: rgba(8, 127, 116, .92);
        backdrop-filter: blur(5px);
        color: #FFFFFF;
        font-size: .75rem;
        font-weight: 700;
        padding: .4rem .9rem;
        border-radius: 50rem;
        border: 1px solid rgba(255, 255, 255, .3);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        z-index: 2;
    }

    .teacher-widget-premium .teacher-name {
        color: var(--teacher-text);
        font-size: 1.05rem;
        font-weight: 800;
        font-family: "Inter", "Segoe UI", Arial, sans-serif;
        line-height: 1.5;
        margin-bottom: .4rem;
    }

    .teacher-widget-premium .teacher-position {
        color: var(--teacher-dark);
        font-size: .84rem;
        font-weight: 700;
        margin-bottom: .75rem;
    }

    .teacher-widget-premium .teacher-subject-detail {
        color: var(--teacher-muted);
        font-size: .8rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-bottom: 1.25rem;
    }

    .teacher-widget-premium .teacher-subject-detail i {
        color: var(--teacher-primary) !important;
    }

    .teacher-widget-premium .teacher-card .card-footer {
        background: #FFFFFF !important;
        border-top: 1px solid #EEF5F3 !important;
    }

    .teacher-widget-premium .btn-profile-outline {
        border: 1.5px solid var(--teacher-primary);
        color: var(--teacher-dark);
        background: #FFFFFF;
        border-radius: 50rem;
        padding: .58rem 1rem;
        font-size: .84rem;
        font-weight: 700;
        width: 85%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background .25s ease, color .25s ease, box-shadow .25s ease;
        text-decoration: none;
    }

    .teacher-widget-premium .teacher-card:hover .btn-profile-outline,
    .teacher-widget-premium .btn-profile-outline:hover {
        background: var(--teacher-primary);
        color: #FFFFFF !important;
        border-color: var(--teacher-primary);
        box-shadow: 0 5px 15px rgba(16, 165, 150, .18);
    }

    .teacher-widget-premium .stats-banner {
        background: #FFFFFF;
        border-radius: 22px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        border: 1px solid var(--teacher-border);
        box-shadow: 0 8px 26px rgba(36, 55, 70, .045);
    }

    .teacher-widget-premium .stat-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        height: 100%;
    }

    .teacher-widget-premium .stat-icon {
        width: 52px;
        height: 52px;
        background: var(--teacher-light);
        color: var(--teacher-primary);
        border: 1px solid #D5F0EB;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .teacher-widget-premium .stat-title {
        color: var(--teacher-dark);
        font-size: 1.1rem;
        font-weight: 800;
        margin-bottom: 3px;
        line-height: 1.45;
        overflow-wrap: anywhere;
    }

    .teacher-widget-premium .stat-desc {
        color: var(--teacher-muted);
        font-size: .77rem;
        line-height: 1.6;
        margin: 0;
    }

    .teacher-widget-premium .stat-desc.fw-semibold,
    .teacher-widget-premium .text-dark {
        color: var(--teacher-text) !important;
    }

    .teacher-widget-premium .empty-state {
        background: #FFFFFF;
        border-radius: 22px;
        border: 2px dashed #B9DDD6;
        padding: 4rem 1.25rem;
    }

    .teacher-widget-premium .empty-state > i {
        color: var(--teacher-primary) !important;
    }

    .teacher-widget-premium .empty-state h6 {
        color: var(--teacher-text);
        font-weight: 800;
    }

    .teacher-widget-premium .empty-state p {
        color: var(--teacher-muted);
    }

    .teacher-widget-premium a:focus-visible {
        outline: 3px solid rgba(16, 165, 150, .5);
        outline-offset: 4px;
    }

    @media (max-width: 991.98px) {
        .teacher-widget-premium {
            padding: 4rem 0;
        }

        .teacher-widget-premium .img-container {
            height: 260px;
        }

        .teacher-widget-premium .stats-banner {
            padding: 1.25rem;
        }
    }

    @media (max-width: 575.98px) {
        .teacher-widget-premium {
            padding: 3.25rem 0;
        }

        .teacher-widget-premium .widget-main-title {
            font-size: 1.85rem;
        }

        .teacher-widget-premium .img-container {
            height: 300px;
        }

        .teacher-widget-premium .stats-banner {
            padding: 1.1rem;
            border-radius: 17px;
        }

        .teacher-widget-premium .stat-icon {
            width: 46px;
            height: 46px;
            flex-basis: 46px;
            font-size: 1.2rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .teacher-widget-premium *,
        .teacher-widget-premium *::before,
        .teacher-widget-premium *::after {
            animation-duration: .01ms !important;
            transition-duration: .01ms !important;
        }
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
