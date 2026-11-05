
<style>
    /* =========================================
       GALERI MADRASAH — CLEAN EDITORIAL DESIGN
    ========================================= */

    .gallery-widget-section {
        --gallery-green: #176b45;
        --gallery-green-dark: #104d33;
        --gallery-text: #18251e;
        --gallery-muted: #737e77;
        --gallery-border: #e6ebe7;
        background: #fff;
        padding: 76px 0 84px;
        font-family: Inter, -apple-system, BlinkMacSystemFont,
                     "Segoe UI", sans-serif;
        color: var(--gallery-text);
    }

    .gallery-widget-section *,
    .gallery-widget-section *::before,
    .gallery-widget-section *::after {
        box-sizing: border-box;
    }

    .gallery-widget-section .container {
        width: 100%;
    }

    /* Header */
    .gallery-header-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 24px;
        margin-bottom: 34px;
    }

    .gallery-header-left {
        display: flex;
        align-items: flex-start;
        gap: 17px;
        min-width: 0;
    }

    .gallery-header-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 48px;
        width: 48px;
        height: 48px;
        margin-top: 3px;
        border-radius: 12px;
        background: #edf5ef;
        color: var(--gallery-green);
        font-size: 19px;
    }

    .gallery-header-text h3 {
        margin: 0 0 8px;
        color: var(--gallery-text);
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(27px, 3vw, 36px);
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -.7px;
    }

    .gallery-header-text p {
        margin: 0;
        color: var(--gallery-muted);
        font-size: 14px;
        line-height: 1.8;
    }

    .gallery-accent-line {
        display: flex;
        gap: 5px;
        margin-top: 17px;
    }

    .gallery-accent-line .line-long {
        width: 34px;
        height: 3px;
        border-radius: 4px;
        background: var(--gallery-green);
    }

    .gallery-accent-line .line-short {
        width: 8px;
        height: 3px;
        border-radius: 4px;
        background: #a9c9b4;
    }

    /* Tombol lihat semua */
    .btn-gallery-view-all {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-shrink: 0;
        min-height: 43px;
        padding: 0 17px;
        border: 1px solid #dce6de;
        border-radius: 8px;
        background: #fff;
        color: var(--gallery-green-dark);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s ease, border-color .2s ease,
                    color .2s ease;
    }

    .btn-gallery-view-all:hover {
        background: var(--gallery-green);
        border-color: var(--gallery-green);
        color: #fff;
    }

    .btn-gallery-view-all i {
        font-size: 11px;
        transition: transform .2s ease;
    }

    .btn-gallery-view-all:hover i:last-child {
        transform: translateX(3px);
    }

    /* Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
        align-items: stretch;
    }

    /* Kartu album */
    .gallery-card {
        display: flex;
        flex-direction: column;
        min-width: 0;
        height: 100%;
        overflow: hidden;
        border: 1px solid var(--gallery-border);
        border-radius: 10px;
        background: #fff;
        color: inherit;
        text-decoration: none;
        transition: border-color .25s ease, box-shadow .25s ease;
    }

    .gallery-card:hover {
        border-color: #c7d9cc;
        box-shadow: 0 12px 28px rgba(22, 56, 36, .09);
        color: inherit;
    }

    /* Foto */
    .gallery-card-image-wrapper {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        background: #f0f3f0;
    }

    .gallery-card-image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform .45s ease;
    }

    .gallery-card:hover .gallery-card-image {
        transform: scale(1.035);
    }

    /* Placeholder saat gambar kosong atau gagal dimuat */
    .gallery-image-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0f3f0;
        color: #a0b0a4;
        font-size: 34px;
    }

    .gallery-card-image[hidden] {
        display: none !important;
    }

    /* Label foto */
    .gallery-photo-count {
        position: absolute;
        top: 12px;
        right: 12px;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 10px;
        border: 1px solid rgba(255,255,255,.65);
        border-radius: 6px;
        background: rgba(255,255,255,.95);
        color: #35463a;
        font-size: 11px;
        font-weight: 600;
        line-height: 1;
    }

    .gallery-photo-count i {
        color: var(--gallery-green);
        font-size: 12px;
    }

    /* Isi kartu */
    .gallery-card-content {
        display: flex;
        flex: 1;
        flex-direction: column;
        align-items: flex-start;
        padding: 17px 17px 14px;
    }

    .gallery-category {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 10px;
        color: var(--gallery-green);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .9px;
        line-height: 1.5;
        text-transform: uppercase;
    }

    .gallery-category i {
        font-size: 11px;
    }

    .gallery-card-title {
        display: -webkit-box;
        overflow: hidden;
        margin: 0;
        color: #202c24;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 18px;
        font-weight: 700;
        line-height: 1.45;
        overflow-wrap: anywhere;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    .gallery-card-description {
        display: -webkit-box;
        overflow: hidden;
        margin: 8px 0 0;
        color: var(--gallery-muted);
        font-size: 12px;
        line-height: 1.75;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    /* Footer kartu */
    .gallery-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: auto;
        padding: 13px 17px;
        border-top: 1px solid #edf0ed;
        background: #fff;
    }

    .gallery-footer-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
        color: #78827b;
        font-size: 11px;
        line-height: 1.5;
    }

    .gallery-footer-date i {
        color: #8c9c90;
        font-size: 12px;
    }

    .gallery-card-arrow {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 30px;
        width: 30px;
        height: 30px;
        border: 1px solid #e3e9e4;
        border-radius: 50%;
        color: var(--gallery-green);
        font-size: 11px;
        transition: background .2s ease, color .2s ease,
                    border-color .2s ease;
    }

    .gallery-card:hover .gallery-card-arrow {
        background: var(--gallery-green);
        border-color: var(--gallery-green);
        color: #fff;
    }

    /* Kondisi galeri kosong */
    .gallery-empty-state {
        grid-column: 1 / -1;
        padding: 62px 24px;
        border: 1px solid var(--gallery-border);
        border-radius: 10px;
        background: #fafcfb;
        text-align: center;
    }

    .gallery-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        margin: 0 auto 19px;
        border-radius: 50%;
        background: #edf5ef;
        color: var(--gallery-green);
        font-size: 22px;
    }

    .gallery-empty-state h4 {
        margin: 0 0 9px;
        color: var(--gallery-text);
        font-family: Georgia, "Times New Roman", serif;
        font-size: 22px;
        font-weight: 700;
    }

    .gallery-empty-state p {
        max-width: 440px;
        margin: 0 auto;
        color: var(--gallery-muted);
        font-size: 13px;
        line-height: 1.8;
    }

    /* Tablet */
    @media (max-width: 1199px) {
        .gallery-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .gallery-widget-section {
            padding: 64px 0 70px;
        }
    }

    @media (max-width: 991px) {
        .gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .gallery-card-title {
            font-size: 17px;
        }
    }

    /* HP */
    @media (max-width: 575px) {
        .gallery-widget-section {
            padding: 45px 0 50px;
        }

        .gallery-header-wrapper {
            align-items: flex-start;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 25px;
        }

        .gallery-header-left {
            gap: 13px;
        }

        .gallery-header-icon {
            flex-basis: 42px;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            font-size: 16px;
        }

        .gallery-header-text h3 {
            font-size: 27px;
        }

        .gallery-header-text p {
            font-size: 12px;
        }

        .gallery-accent-line {
            margin-top: 13px;
        }

        .btn-gallery-view-all {
            width: 100%;
        }

        .gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .gallery-card {
            border-radius: 8px;
        }

        .gallery-card-image-wrapper {
            aspect-ratio: 4 / 3;
        }

        .gallery-photo-count {
            top: 7px;
            right: 7px;
            gap: 5px;
            padding: 6px 7px;
            font-size: 9px;
        }

        .gallery-card-content {
            padding: 12px 11px 10px;
        }

        .gallery-category {
            gap: 5px;
            margin-bottom: 7px;
            font-size: 8px;
            letter-spacing: .5px;
        }

        .gallery-card-title {
            font-size: 14px;
            line-height: 1.45;
        }

        .gallery-card-description {
            margin-top: 6px;
            font-size: 10px;
            line-height: 1.6;
        }

        .gallery-card-footer {
            gap: 6px;
            padding: 10px 11px;
        }

        .gallery-footer-date {
            gap: 5px;
            font-size: 9px;
        }

        .gallery-card-arrow {
            flex-basis: 25px;
            width: 25px;
            height: 25px;
            font-size: 9px;
        }

        .gallery-empty-state {
            padding: 42px 18px;
        }

        .gallery-empty-state h4 {
            font-size: 20px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .gallery-widget-section *,
        .gallery-widget-section *::before,
        .gallery-widget-section *::after {
            transition: none !important;
        }
    }
</style>

<!-- GALERI KEGIATAN MADRASAH -->
<section class="gallery-widget-section" aria-labelledby="gallery-heading">
    <div class="container">

        <!-- Judul -->
        <div class="gallery-header-wrapper">
            <div class="gallery-header-left">
                <div class="gallery-header-icon" aria-hidden="true">
                    <i class="fas fa-images"></i>
                </div>

                <div class="gallery-header-text">
                    <h3 id="gallery-heading">Galeri Kegiatan</h3>
                    <p>
                        Rekam jejak kegiatan, kebersamaan, dan prestasi madrasah.
                    </p>

                    <div class="gallery-accent-line" aria-hidden="true">
                        <span class="line-long"></span>
                        <span class="line-short"></span>
                    </div>
                </div>
            </div>

            @if(isset($galleries) && $galleries->count() > 0)
                <a href="{{ route('galleries.index') }}"
                   class="btn-gallery-view-all">
                    Jelajahi Semua Galeri
                    <i class="fas fa-arrow-right"></i>
                </a>
            @endif
        </div>

        <!-- Daftar album -->
        <div class="gallery-grid">
            @forelse($galleries as $index => $gallery)
                <a href="{{ route('galleries.show', $gallery->slug) }}"
                   class="gallery-card"
                   id="gallery-widget-{{ $gallery->id }}"
                   aria-label="Lihat album {{ $gallery->title }}">

                    <!-- Foto sampul -->
                    <div class="gallery-card-image-wrapper">
                        <div class="gallery-image-placeholder"
                             aria-hidden="true">
                            <i class="far fa-image"></i>
                        </div>

                        <img
                            src="{{ asset('storage/' . ($gallery->thumbnail ?: $gallery->image)) }}"
                            alt="{{ $gallery->title }}"
                            loading="lazy"
                            decoding="async"
                            class="gallery-card-image"
                            onload="this.previousElementSibling.style.display='none'"
                            onerror="this.hidden=true"
                        >

                        @if(isset($gallery->photos_count) && $gallery->photos_count !== null)
                            <div class="gallery-photo-count">
                                <i class="far fa-images"></i>
                                <span>{{ $gallery->photos_count }} foto</span>
                            </div>
                        @endif
                    </div>

                    <!-- Informasi album -->
                    <div class="gallery-card-content">
                        <span class="gallery-category">
                            <i class="fas fa-folder-open"></i>
                            {{ $index === 0 ? 'Album Terbaru' : 'Dokumentasi' }}
                        </span>

                        <h4 class="gallery-card-title">
                            {{ $gallery->title }}
                        </h4>

                        @if(!empty($gallery->description))
                            <p class="gallery-card-description">
                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags($gallery->description), 95
                                ) }}
                            </p>
                        @endif
                    </div>

                    <!-- Informasi tanggal -->
                    <div class="gallery-card-footer">
                        <span class="gallery-footer-date">
                            <i class="far fa-calendar-alt"></i>

                            @if($gallery->created_at)
                                {{ $gallery->created_at->translatedFormat('d M Y') }}
                            @else
                                Dokumentasi madrasah
                            @endif
                        </span>

                        <span class="gallery-card-arrow" aria-hidden="true">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>

                </a>
            @empty
                <div class="gallery-empty-state">
                    <div class="gallery-empty-icon">
                        <i class="far fa-images"></i>
                    </div>

                    <h4>Galeri Sedang Dipersiapkan</h4>

                    <p>
                        Dokumentasi kegiatan dan momen berharga
                        MA Miftahul Midad akan ditampilkan di halaman ini.
                        Silakan kunjungi kembali untuk melihat pembaruan.
                    </p>
                </div>
            @endforelse
        </div>

    </div>
</section>
