
@extends('layouts.app')

@section('content')

<style>
    /* =========================================
       SEJARAH MADRASAH - PROFESSIONAL DESIGN
    ========================================= */

    .history-page {
        --history-primary: #087F74;
        --history-secondary: #10A596;
        --history-dark: #163B3A;
        --history-muted: #64748B;
        --history-bg: #F5F9F8;
        --history-border: #E1ECE9;
        color: #243746;
        overflow: hidden;
    }

    /* HERO */
    .history-hero {
        position: relative;
        padding: 95px 20px 105px;
        color: #fff;
        text-align: center;
        background:
            radial-gradient(circle at 15% 20%, rgba(255,255,255,.13), transparent 25%),
            radial-gradient(circle at 85% 80%, rgba(255,255,255,.12), transparent 28%),
            linear-gradient(135deg, #075F59 0%, #087F74 48%, #13A99A 100%);
    }

    .history-hero::before,
    .history-hero::after {
        content: "";
        position: absolute;
        border: 1px solid rgba(255,255,255,.13);
        border-radius: 50%;
        pointer-events: none;
    }

    .history-hero::before {
        width: 350px;
        height: 350px;
        top: -210px;
        left: -100px;
    }

    .history-hero::after {
        width: 450px;
        height: 450px;
        right: -180px;
        bottom: -300px;
    }

    .history-hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: auto;
    }

    .history-eyebrow {
        display: inline-block;
        padding: 8px 17px;
        margin-bottom: 20px;
        border: 1px solid rgba(255,255,255,.35);
        border-radius: 50px;
        background: rgba(255,255,255,.10);
        color: #fff;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .history-hero h1 {
        margin-bottom: 17px;
        font-size: clamp(2.2rem, 5vw, 3.6rem);
        font-weight: 800;
        letter-spacing: -.8px;
    }

    .history-hero p {
        max-width: 620px;
        margin: auto;
        color: rgba(255,255,255,.88);
        font-size: 1.05rem;
        line-height: 1.8;
    }

    /* MAIN SECTION */
    .history-main {
        padding: 80px 0 90px;
        background: var(--history-bg);
    }

    .history-container {
        max-width: 1120px;
    }

    /* SECTION HEADING */
    .history-heading {
        margin-bottom: 38px;
        text-align: center;
    }

    .history-heading .section-label {
        display: inline-block;
        margin-bottom: 12px;
        color: var(--history-secondary);
        font-size: .73rem;
        font-weight: 800;
        letter-spacing: 2.5px;
    }

    .history-heading h2 {
        margin-bottom: 14px;
        color: var(--history-dark);
        font-size: clamp(1.7rem, 3vw, 2.4rem);
        font-weight: 800;
    }

    .history-heading .heading-line {
        display: block;
        width: 65px;
        height: 4px;
        margin: 0 auto;
        border-radius: 10px;
        background: var(--history-secondary);
    }

    /* HISTORY CONTENT */
    .history-content-card {
        position: relative;
        padding: 48px 55px;
        border: 1px solid var(--history-border);
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 12px 35px rgba(15, 75, 68, .055);
    }

    .history-content-card::before {
        content: "";
        position: absolute;
        top: 38px;
        bottom: 38px;
        left: 0;
        width: 4px;
        border-radius: 0 5px 5px 0;
        background: var(--history-secondary);
    }

    .history-content-label {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 23px;
        color: var(--history-primary);
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: 1.3px;
    }

    .history-content-label i {
        font-size: 1.2rem;
    }

    .history-description {
        color: #40545D;
        font-size: 1.02rem;
        line-height: 2.05;
        text-align: justify;
        overflow-wrap: anywhere;
        white-space: normal;
    }

    .history-description p:last-child {
        margin-bottom: 0;
    }

    /* GALLERY */
    .history-gallery-section {
        margin-top: 75px;
    }

    .history-gallery-heading {
        margin-bottom: 30px;
        text-align: center;
    }

    .history-gallery-heading h3 {
        margin-bottom: 9px;
        color: var(--history-dark);
        font-size: 1.65rem;
        font-weight: 800;
    }

    .history-gallery-heading p {
        margin: 0;
        color: var(--history-muted);
        font-size: .95rem;
    }

    .history-gallery {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 25px;
        align-items: stretch;
    }

    .history-gallery-item {
        position: relative;
        min-width: 0;
        height: 350px;
        padding: 9px;
        overflow: hidden;
        border: 1px solid var(--history-border);
        border-radius: 19px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(15, 75, 68, .07);
    }

    .history-gallery-item img {
        display: block;
        width: 100%;
        height: 100%;
        border-radius: 12px;
        object-fit: cover;
        transition: transform .5s ease;
    }

    .history-gallery-item:hover img {
        transform: scale(1.045);
    }

    .history-gallery-item::after {
        content: "";
        position: absolute;
        inset: 9px;
        border-radius: 12px;
        background: linear-gradient(
            to top,
            rgba(5, 45, 42, .20),
            transparent 40%
        );
        pointer-events: none;
    }

    /* EMPTY STATE */
    .history-empty {
        padding: 55px 25px;
        border: 1px dashed #B9D7D1;
        border-radius: 20px;
        background: #fff;
        text-align: center;
    }

    .history-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 75px;
        height: 75px;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: #E7F5F2;
        color: var(--history-primary);
        font-size: 2rem;
    }

    .history-empty h4 {
        margin-bottom: 10px;
        color: var(--history-dark);
        font-weight: 800;
    }

    .history-empty p {
        max-width: 480px;
        margin: auto;
        color: var(--history-muted);
        line-height: 1.8;
    }

    /* RESPONSIVE */
    @media (max-width: 767px) {
        .history-hero {
            padding: 65px 18px 75px;
        }

        .history-hero p {
            font-size: .95rem;
        }

        .history-main {
            padding: 55px 0 65px;
        }

        .history-content-card {
            padding: 30px 25px;
            border-radius: 15px;
        }

        .history-content-card::before {
            top: 25px;
            bottom: 25px;
        }

        .history-description {
            font-size: .96rem;
            line-height: 1.9;
            text-align: left;
        }

        .history-gallery-section {
            margin-top: 55px;
        }

        .history-gallery {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .history-gallery-item {
            height: 280px;
        }
    }

    @media (max-width: 420px) {
        .history-gallery-item {
            height: 235px;
        }

        .history-content-card {
            padding: 27px 20px;
        }
    }
</style>

<div class="history-page">

    {{-- HERO --}}
    <section class="history-hero">
        <div class="history-hero-content">

            <h1>Sejarah Madrasah</h1>

            <p>
                Mengenal perjalanan, perjuangan, dan perkembangan
                MA Miftahul Midad dalam membangun pendidikan
                yang unggul dan berlandaskan nilai-nilai kepesantrenan.
            </p>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <section class="history-main">
        <div class="container history-container">

            {{-- HEADING --}}
            <div class="history-heading">
                <span class="section-label">PERJALANAN KAMI</span>
                <h2>Sejarah MA Miftahul Midad</h2>
                <span class="heading-line"></span>
            </div>

            {{-- HISTORY TEXT --}}
            @if($history && filled($history->history))

                <article class="history-content-card">

                    <div class="history-content-label">
                        <i class="bi bi-book-half"></i>
                        <span>LATAR BELAKANG MADRASAH</span>
                    </div>

                    <div class="history-description">
                        {!! nl2br(e($history->history)) !!}
                    </div>

                </article>

            @else

                <div class="history-empty">
                    <div class="history-empty-icon">
                        <i class="bi bi-book"></i>
                    </div>

                    <h4>Sejarah Madrasah Belum Tersedia</h4>

                    <p>
                        Informasi mengenai sejarah MA Miftahul Midad
                        akan ditampilkan setelah diperbarui oleh
                        administrator.
                    </p>
                </div>

            @endif

            {{-- PHOTO GALLERY --}}
            @if($history && ($history->photo_1 || $history->photo_2))

                <section class="history-gallery-section">

                    <div class="history-gallery-heading">
                        <h3>Dokumentasi Perjalanan Madrasah</h3>
                        <p>
                            Dokumentasi yang menggambarkan perjalanan
                            dan perkembangan MA Miftahul Midad.
                        </p>
                    </div>

                    <div class="history-gallery">

                        @if($history->photo_1)
                            <div class="history-gallery-item">
                                <img
                                    src="{{ asset('storage/' . $history->photo_1) }}"
                                    alt="Dokumentasi sejarah MA Miftahul Midad"
                                    loading="lazy"
                                >
                            </div>
                        @endif

                        @if($history->photo_2)
                            <div class="history-gallery-item">
                                <img
                                    src="{{ asset('storage/' . $history->photo_2) }}"
                                    alt="Dokumentasi perkembangan MA Miftahul Midad"
                                    loading="lazy"
                                >
                            </div>
                        @endif

                    </div>

                </section>

            @endif

        </div>
    </section>

</div>

@endsection
