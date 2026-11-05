
@extends('layouts.app')

@section('content')

<style>
    /* =========================================
       PROGRAM MADRASAH
       MA MIFTAHUL MIDAD
       ========================================= */

    .madrasah-program {
        --program-primary: #10A596;
        --program-primary-dark: #087F74;
        --program-primary-soft: #E7F7F4;
        --program-background: #F7FAF9;
        --program-border: #E1EBE8;
        --program-text: #263832;
        --program-muted: #6B7B75;

        background: var(--program-background);
        color: var(--program-text);
        padding: 64px 0 76px;
        min-height: 65vh;
    }

    .madrasah-program * {
        box-sizing: border-box;
    }

    /* Header halaman */

    .madrasah-program .program-header {
        max-width: 720px;
        margin: 0 auto 44px;
        text-align: center;
    }

    .madrasah-program .program-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 16px;
        color: var(--program-primary-dark);
        font-size: 12px;
        font-weight: 750;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    .madrasah-program .program-eyebrow::before,
    .madrasah-program .program-eyebrow::after {
        content: "";
        width: 22px;
        height: 2px;
        border-radius: 2px;
        background: var(--program-primary);
    }


/* Judul halaman */
.madrasah-program .program-title {
    margin: 0 0 15px;
    color: #08B4AD;
    font-size: clamp(30px, 4vw, 43px);
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: -1px;
}

/* Garis turquoise di bawah judul */
.madrasah-program .program-divider {
    width: 58px;
    height: 4px;
    margin: 23px auto 0;
    border-radius: 5px;
    background: #08B4AD;
}


    .madrasah-program .program-intro {
        max-width: 580px;
        margin: 0 auto;
        color: var(--program-muted);
        font-size: 15px;
        line-height: 1.85;
    }

    /* Grid kategori */

    .madrasah-program .program-grid {
        row-gap: 24px;
    }

    /* Kartu kategori */

    .madrasah-program .program-card {
        height: 100%;
        overflow: hidden;
        background: #FFFFFF;
        border: 1px solid var(--program-border);
        border-radius: 15px;
        box-shadow: 0 3px 12px rgba(29, 65, 53, 0.035);
        transition:
            border-color 0.22s ease,
            box-shadow 0.22s ease,
            transform 0.22s ease;
    }

    .madrasah-program .program-card:hover {
        transform: translateY(-3px);
        border-color: rgba(16, 165, 150, 0.45);
        box-shadow: 0 10px 26px rgba(29, 65, 53, 0.075);
    }

    /* Header setiap kategori */

    .madrasah-program .program-card-header {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 25px 25px 21px;
        border-bottom: 1px solid #EDF2F0;
    }

    .madrasah-program .program-icon {
        display: flex;
        flex: 0 0 48px;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--program-primary-soft);
        color: var(--program-primary-dark);
        font-size: 21px;
    }

    .madrasah-program .program-category-number {
        display: block;
        margin-bottom: 4px;
        color: var(--program-primary-dark);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.3px;
        text-transform: uppercase;
    }

    .madrasah-program .program-category-title {
        margin: 0;
        color: #263D34;
        font-size: 17px;
        font-weight: 750;
        line-height: 1.45;
    }

    /* Daftar program */

    .madrasah-program .program-card-body {
        padding: 7px 25px 20px;
    }

    .madrasah-program .program-item {
        position: relative;
        padding: 19px 0;
        border-bottom: 1px solid #EDF2F0;
    }

    .madrasah-program .program-item:last-child {
        padding-bottom: 7px;
        border-bottom: none;
    }

    .madrasah-program .program-item-title {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin: 0 0 8px;
        color: var(--program-text);
        font-size: 14px;
        font-weight: 750;
        line-height: 1.65;
    }

    .madrasah-program .program-item-number {
        display: inline-flex;
        flex: 0 0 25px;
        align-items: center;
        justify-content: center;
        width: 25px;
        height: 25px;
        margin-top: 1px;
        border-radius: 7px;
        background: #F0F7F5;
        color: var(--program-primary-dark);
        font-size: 11px;
        font-weight: 800;
    }

    .madrasah-program .program-description {
        margin: 0 0 0 36px;
        color: var(--program-muted);
        font-size: 13px;
        line-height: 1.85;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    /* Kondisi kategori belum memiliki program */

    .madrasah-program .program-empty {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin: 17px 0 5px;
        padding: 16px;
        border: 1px dashed #D8E8E3;
        border-radius: 10px;
        background: #FAFCFB;
        color: var(--program-muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .madrasah-program .program-empty i {
        margin-top: 2px;
        color: var(--program-primary);
        font-size: 17px;
    }

    /* Penutup halaman */

    .madrasah-program .program-footer-note {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        max-width: 760px;
        margin: 35px auto 0;
        padding: 19px 22px;
        border: 1px solid var(--program-border);
        border-radius: 12px;
        background: #FFFFFF;
    }

    .madrasah-program .program-footer-note > i {
        margin-top: 3px;
        color: var(--program-primary);
        font-size: 20px;
    }

    .madrasah-program .program-footer-note p {
        margin: 0;
        color: var(--program-muted);
        font-size: 12px;
        line-height: 1.8;
    }

    .madrasah-program .program-footer-note strong {
        color: var(--program-text);
    }

    /* Responsif tablet dan ponsel */

    @media (max-width: 767.98px) {
        .madrasah-program {
            padding: 43px 0 52px;
        }

        .madrasah-program .program-header {
            margin-bottom: 30px;
        }

        .madrasah-program .program-title {
            font-size: 31px;
            letter-spacing: -0.6px;
        }

        .madrasah-program .program-intro {
            padding: 0 8px;
            font-size: 14px;
        }

        .madrasah-program .program-card-header {
            gap: 13px;
            padding: 21px 19px 18px;
        }

        .madrasah-program .program-card-body {
            padding: 5px 19px 17px;
        }

        .madrasah-program .program-category-title {
            font-size: 16px;
        }

        .madrasah-program .program-footer-note {
            margin-top: 26px;
            padding: 17px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .madrasah-program .program-card {
            transition: none;
        }

        .madrasah-program .program-card:hover {
            transform: none;
        }
    }
</style>

<section class="madrasah-program">
    <div class="container">

        {{-- Header halaman --}}
        <header class="program-header">

            <h1 class="program-title">
                Program Madrasah
            </h1>

            <p class="program-intro">
                Berbagai program madrasah untuk mendukung proses
                pembelajaran, pengembangan peserta didik, hubungan
                dengan masyarakat, serta pengelolaan lingkungan sekolah.
            </p>

            <div class="program-divider"></div>
        </header>

        @php
            $icons = [
                'curriculum' => 'bi-journal-bookmark',
                'student_affairs' => 'bi-people',
                'public_relations' => 'bi-megaphone',
                'facilities' => 'bi-building',
            ];

            $categoryKeys = array_keys($categories);
        @endphp

        {{-- Daftar program berdasarkan kategori --}}
        <div class="row g-4 program-grid">

            @foreach ($categories as $key => $label)
                <div class="col-12 col-lg-6">

                    <section class="program-card">

                        {{-- Judul kategori --}}
                        <div class="program-card-header">

                            <div class="program-icon" aria-hidden="true">
                                <i class="bi {{ $icons[$key] ?? 'bi-list-check' }}"></i>
                            </div>

                            <div>
                                <span class="program-category-number">
                                    Bidang {{ chr(65 + array_search($key, $categoryKeys)) }}
                                </span>

                                <h2 class="program-category-title">
                                    {{ $label }}
                                </h2>
                            </div>

                        </div>

                        {{-- Isi program --}}
                        <div class="program-card-body">

                            @forelse ($programs->get($key, collect()) as $index => $program)

                                <article class="program-item">

                                    <h3 class="program-item-title">
                                        <span class="program-item-number">
                                            {{ $index + 1 }}
                                        </span>

                                        <span>
                                            {{ $program->title }}
                                        </span>
                                    </h3>

                                    @if ($program->description)
                                        <p class="program-description">{{ $program->description }}</p>
                                    @endif

                                </article>

                            @empty

                                <div class="program-empty">
                                    <i class="bi bi-info-circle" aria-hidden="true"></i>

                                    <p class="mb-0">
                                        Belum ada program yang ditampilkan
                                        pada kategori ini.
                                    </p>
                                </div>

                            @endforelse

                        </div>
                    </section>

                </div>
            @endforeach

        </div>

        {{-- Informasi penutup --}}
        <div class="program-footer-note">
            <i class="bi bi-info-circle" aria-hidden="true"></i>

            <p>
                <strong>Informasi program.</strong>
                Program yang tercantum pada halaman ini mengikuti data
                yang dipublikasikan oleh pihak MA Miftahul Midad.
                Untuk informasi lebih lanjut, silakan menghubungi pihak madrasah.
            </p>
        </div>

    </div>
</section>

@endsection
