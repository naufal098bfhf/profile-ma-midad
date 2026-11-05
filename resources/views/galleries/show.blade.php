
@extends('layouts.app')

@section('title', $gallery->title . ' - Galeri Foto')
@section('description', $gallery->description)

@push('styles')
    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $gallery->title }} - Galeri Foto">
    <meta property="og:description" content="{{ $gallery->description }}">
    <meta property="og:url" content="{{ request()->url() }}">

    @if($gallery->image)
        <meta property="og:image" content="{{ asset('storage/' . $gallery->image) }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
    @endif

    <meta property="og:locale" content="id_ID">
    <meta property="article:author" content="SMPIT Al-Itqon">
    <meta property="article:published_time" content="{{ $gallery->created_at->toISOString() }}">
    <meta property="article:section" content="Galeri Foto">

    @if($gallery->category)
        <meta property="article:tag" content="{{ $gallery->category->name }}">
    @endif

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $gallery->title }} - Galeri Foto">
    <meta name="twitter:description" content="{{ $gallery->description }}">

    @if($gallery->image)
        <meta name="twitter:image" content="{{ asset('storage/' . $gallery->image) }}">
    @endif

    <style>
        /* =================================
           MAIN CONTENT
        ================================= */

        .gallery-detail {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 3px 18px rgba(0,0,0,.045);
        }

        .gallery-title {
            font-size: 2.1rem;
            font-weight: 700;
            color: #263238;
            line-height: 1.35;
            margin-bottom: 12px;
        }

        .gallery-meta .badge {
            font-size: .85rem;
            padding: 9px 15px;
            border-radius: 30px;
        }

        .gallery-stats {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 7px;
            color: #7b858c;
            font-size: 13px;
        }

        /* =================================
           ALBUM PHOTO VIEWER
        ================================= */

        .album-viewer {
            width: 100%;
            margin: 0 auto 28px;
        }

        .album-slider {
            position: relative;
            width: 100%;
            height: clamp(350px, 62vw, 570px);
            background: #f5f6f8;
            border: 1px solid #edf0f2;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 28px rgba(20,35,45,.07);
        }

        .album-track {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform 550ms cubic-bezier(.22,.61,.36,1);
            will-change: transform;
            touch-action: pan-y;
        }

        .album-slide {
            flex: 0 0 100%;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px 70px;
        }

        .album-slide img {
            display: block;
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 5px;
            user-select: none;
            -webkit-user-drag: none;
        }

        /* =================================
           ARROW BUTTON
        ================================= */

        .album-arrow {
            position: absolute;
            z-index: 5;
            top: 50%;
            transform: translateY(-50%);
            width: 46px;
            height: 46px;
            border: 1px solid rgba(255,255,255,.65);
            border-radius: 50%;
            background: rgba(30,40,48,.48);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            cursor: pointer;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: 0 3px 12px rgba(0,0,0,.12);
            transition:
                background .3s ease,
                transform .3s ease,
                box-shadow .3s ease,
                opacity .3s ease;
            opacity: .78;
        }

        .album-arrow-prev {
            left: 18px;
        }

        .album-arrow-next {
            right: 18px;
        }

        .album-arrow:hover {
            background: #03aca5;
            opacity: 1;
            transform: translateY(-50%) scale(1.09);
            box-shadow: 0 6px 18px rgba(3,172,165,.28);
            color: #ffffff;
        }

        .album-arrow:active {
            transform: translateY(-50%) scale(.94);
        }

        .album-arrow:focus-visible {
            outline: 3px solid rgba(3,172,165,.35);
            outline-offset: 3px;
        }

        /* =================================
           PHOTO COUNTER
        ================================= */

        .album-counter {
            position: absolute;
            right: 18px;
            bottom: 16px;
            z-index: 5;
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 14px;
            color: #ffffff;
            background: rgba(30,40,48,.72);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .counter-divider {
            opacity: .55;
        }

        /* =================================
           THUMBNAIL NAVIGATION
        ================================= */

        .album-thumbnails {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 14px 2px 8px;
            scrollbar-width: thin;
            scrollbar-color: #cbd5d8 transparent;
        }

        .album-thumb {
            flex: 0 0 76px;
            width: 76px;
            height: 62px;
            padding: 0;
            border: 2px solid transparent;
            border-radius: 9px;
            overflow: hidden;
            background: #f1f3f4;
            cursor: pointer;
            opacity: .65;
            transition: all .3s ease;
        }

        .album-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .album-thumb:hover {
            opacity: .9;
            transform: translateY(-2px);
        }

        .album-thumb.active {
            opacity: 1;
            border-color: #03aca5;
            box-shadow: 0 3px 10px rgba(3,172,165,.2);
        }

        /* =================================
           DESCRIPTION
        ================================= */

        .gallery-description {
            margin-top: 30px;
        }

        .gallery-description h4 {
            color: #263238;
            margin-bottom: 12px;
            font-size: 1.3rem;
            font-weight: 650;
        }

        .gallery-description p {
            color: #68757c;
            line-height: 1.8;
            font-size: 1rem;
            margin-bottom: 0;
        }

        .gallery-actions {
            padding-top: 25px;
            border-top: 1px solid #edf0f2;
        }

        /* =================================
           SIDEBAR
        ================================= */

        .sidebar-widget {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 2rem;
        }

        .widget-title {
            font-size: 1.2rem;
            font-weight: 650;
            color: #263238;
            margin-bottom: 1.2rem;
            padding-bottom: .7rem;
            border-bottom: 2px solid #03aca5;
        }

        .related-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .related-item:last-child {
            border-bottom: none;
        }

        .related-image {
            width: 80px;
            height: 65px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            background: #e9ecef;
        }

        .related-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .related-info h6 {
            margin-bottom: 5px;
            font-size: .9rem;
            line-height: 1.4;
        }

        .related-info a {
            color: #333;
            transition: color .3s ease;
        }

        .related-info a:hover {
            color: #03aca5;
        }

        .quick-links {
            display: flex;
            flex-direction: column;
            gap: .7rem;
        }

        .quick-link {
            display: flex;
            align-items: center;
            gap: .8rem;
            padding: .8rem 1rem;
            background: #ffffff;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            transition: all .3s ease;
            border: 1px solid #e9ecef;
        }

        .quick-link:hover {
            background: #03aca5;
            color: #ffffff;
            text-decoration: none;
            transform: translateX(4px);
        }

        /* =================================
           RESPONSIVE
        ================================= */

        @media (max-width: 991px) {
            .gallery-detail {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .gallery-detail {
                padding: 1.2rem;
            }

            .gallery-title {
                font-size: 1.7rem;
            }

            .album-slider {
                height: 420px;
                border-radius: 12px;
            }

            .album-slide {
                padding: 15px 48px;
            }

            .album-arrow {
                width: 38px;
                height: 38px;
                font-size: 12px;
            }

            .album-arrow-prev {
                left: 10px;
            }

            .album-arrow-next {
                right: 10px;
            }

            .album-counter {
                right: 12px;
                bottom: 12px;
            }

            .album-thumb {
                flex-basis: 65px;
                width: 65px;
                height: 54px;
            }

            .gallery-actions {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .gallery-actions .float-end {
                float: none !important;
            }

            .gallery-actions .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .album-slider {
                height: 350px;
            }

            .album-slide {
                padding: 12px 38px;
            }
        }

        /* =================================
           PRINT
        ================================= */

        @media print {
            .gallery-actions,
            .sidebar-widget,
            .album-arrow,
            .album-thumbnails {
                display: none !important;
            }
        }

        /* Reduce motion accessibility */
        @media (prefers-reduced-motion: reduce) {
            .album-track,
            .album-arrow,
            .album-thumb {
                transition: none !important;
            }
        }
    </style>
@endpush


@section('content')

@php
    $albumPhotos = $gallery->photos;

    // Foto cover menjadi cadangan untuk album lama
    // yang belum mempunyai data di gallery_photos.
    if ($albumPhotos->isEmpty() && $gallery->image) {
        $albumPhotos = collect([
            (object) [
                'image' => $gallery->image,
                'thumbnail' => $gallery->thumbnail,
            ]
        ]);
    }

    $totalPhotos = $albumPhotos->count();
@endphp

<div class="container mt-4">

    <div class="row">

        <!-- =================================
             MAIN CONTENT
        ================================= -->

        <div class="col-lg-8">

            <article class="gallery-detail">

                <!-- HEADER ALBUM -->

                <div class="gallery-header mb-4">

                    <div class="gallery-meta mb-3">

                        <span class="badge bg-{{ $gallery->category_color }}">
                            <i class="{{ $gallery->category_icon }}"></i>
                            {{ $gallery->category_label }}
                        </span>

                    </div>

                    <h1 class="gallery-title">
                        {{ $gallery->title }}
                    </h1>

                    <div class="gallery-stats">

                        <small>
                            <i class="fas fa-eye"></i>
                            {{ number_format($gallery->views) }} kali dilihat
                        </small>

                        <span>|</span>

                        <small>
                            <i class="fas fa-images"></i>
                            {{ $totalPhotos }} Foto
                        </small>

                    </div>

                </div>


                <!-- =================================
                     PHOTO SLIDER
                ================================= -->

                @if($totalPhotos > 0)

                    <div class="album-viewer" id="albumViewer">

                        <div class="album-slider">

                            <!-- TRACK FOTO -->

                            <div class="album-track" id="albumTrack">

                                @foreach($albumPhotos as $photo)

                                    <div class="album-slide">

                                        <img
                                            src="{{ asset('storage/' . $photo->image) }}"
                                            alt="{{ $gallery->title }} - Foto {{ $loop->iteration }}"
                                            loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                        >

                                    </div>

                                @endforeach

                            </div>


                            <!-- TOMBOL NAVIGASI -->

                            @if($totalPhotos > 1)

                                <button
                                    type="button"
                                    class="album-arrow album-arrow-prev"
                                    id="albumPrev"
                                    aria-label="Foto sebelumnya">

                                    <i class="fas fa-chevron-left"></i>

                                </button>


                                <button
                                    type="button"
                                    class="album-arrow album-arrow-next"
                                    id="albumNext"
                                    aria-label="Foto berikutnya">

                                    <i class="fas fa-chevron-right"></i>

                                </button>

                            @endif


                            <!-- NOMOR FOTO -->

                            <div class="album-counter">

                                <span id="currentPhoto">1</span>

                                <span class="counter-divider">/</span>

                                <span>{{ $totalPhotos }}</span>

                            </div>

                        </div>


                        <!-- THUMBNAIL FOTO -->

                        @if($totalPhotos > 1)

                            <div class="album-thumbnails" id="albumThumbnails">

                                @foreach($albumPhotos as $photo)

                                    <button
                                        type="button"
                                        class="album-thumb {{ $loop->first ? 'active' : '' }}"
                                        data-index="{{ $loop->index }}"
                                        aria-label="Lihat foto {{ $loop->iteration }}">

                                        <img
                                            src="{{ asset('storage/' . ($photo->thumbnail ?? $photo->image)) }}"
                                            alt="Thumbnail {{ $loop->iteration }}"
                                            loading="lazy"
                                        >

                                    </button>

                                @endforeach

                            </div>

                        @endif

                    </div>

                @else

                    <div class="alert alert-light text-center">
                        <i class="fas fa-images fa-2x mb-2"></i>
                        <p class="mb-0">Belum ada foto dalam album ini.</p>
                    </div>

                @endif


                <!-- =================================
                     PREVIOUS / NEXT ALBUM
                ================================= -->

                <div class="d-flex justify-content-between align-items-center mt-4">

                    @if($previousGallery)

                        <a href="{{ route('galleries.show', $previousGallery->slug) }}"
                           class="btn btn-outline-secondary">

                            <i class="fas fa-arrow-left"></i>
                            Sebelumnya

                        </a>

                    @else

                        <span></span>

                    @endif


                    @if($nextGallery)

                        <a href="{{ route('galleries.show', $nextGallery->slug) }}"
                           class="btn btn-outline-secondary">

                            Selanjutnya
                            <i class="fas fa-arrow-right"></i>

                        </a>

                    @endif

                </div>


                <!-- =================================
                     DESCRIPTION
                ================================= -->

                @if($gallery->description)

                    <div class="gallery-description">

                        <h4>Deskripsi</h4>

                        <p>
                            {{ $gallery->description }}
                        </p>

                    </div>

                @endif


                <!-- =================================
                     ACTIONS
                ================================= -->

                <div class="gallery-actions mt-4">

                    <a href="{{ route('galleries.index') }}"
                       class="btn btn-outline-primary">

                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Galeri

                    </a>

                    <div class="float-end">

                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            onclick="window.print()">

                            <i class="fas fa-print"></i>
                            Cetak

                        </button>

                    </div>

                </div>

            </article>

        </div>


        <!-- =================================
             SIDEBAR
        ================================= -->

        <div class="col-lg-4">

            <!-- GALERI TERKAIT -->

            @if($relatedGalleries->count() > 0)

                <div class="sidebar-widget">

                    <h4 class="widget-title">
                        Galeri Terkait
                    </h4>

                    <div class="related-galleries">

                        @foreach($relatedGalleries as $related)

                            <div class="related-item">

                                <div class="related-image">

                                    <a href="{{ route('galleries.show', $related->slug) }}">

                                        @if($related->thumbnail || $related->image)

                                            <img
                                                src="{{ asset('storage/' . ($related->thumbnail ?? $related->image)) }}"
                                                alt="{{ $related->title }}"
                                                class="img-fluid"
                                            >

                                        @else

                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <i class="fas fa-images text-muted"></i>
                                            </div>

                                        @endif

                                    </a>

                                </div>

                                <div class="related-info">

                                    <h6>

                                        <a href="{{ route('galleries.show', $related->slug) }}"
                                           class="text-decoration-none">

                                            {{ $related->title }}

                                        </a>

                                    </h6>

                                    <small class="text-muted">

                                        <i class="fas fa-eye"></i>
                                        {{ number_format($related->views) }} kali dilihat

                                    </small>

                                    <br>

                                    <small class="text-muted">

                                        <i class="fas fa-images"></i>
                                        {{ $related->photos_count ?? 0 }} Foto

                                    </small>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            <!-- KATEGORI GALERI -->

            <div class="sidebar-widget">

                <h4 class="widget-title">
                    Kategori Galeri
                </h4>

                <div class="quick-links">

                    <a href="{{ route('galleries.index') }}"
                       class="quick-link">

                        <i class="fas fa-th"></i>
                        Semua Galeri

                    </a>

                    <a href="{{ route('galleries.index', ['category' => 'kegiatan-belajar']) }}"
                       class="quick-link">

                        <i class="fas fa-book"></i>
                        Kegiatan Belajar

                    </a>

                    <a href="{{ route('galleries.index', ['category' => 'ekstrakurikuler']) }}"
                       class="quick-link">

                        <i class="fas fa-futbol"></i>
                        Ekstrakurikuler

                    </a>

                    <a href="{{ route('galleries.index', ['category' => 'acara-sekolah']) }}"
                       class="quick-link">

                        <i class="fas fa-calendar-check"></i>
                        Acara Sekolah

                    </a>

                    <a href="{{ route('galleries.index', ['category' => 'fasilitas']) }}"
                       class="quick-link">

                        <i class="fas fa-building"></i>
                        Fasilitas

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =================================
     SLIDER JAVASCRIPT
================================= -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    const viewer = document.getElementById('albumViewer');

    if (!viewer) return;

    const track = viewer.querySelector('#albumTrack');
    const slides = viewer.querySelectorAll('.album-slide');
    const prevButton = viewer.querySelector('#albumPrev');
    const nextButton = viewer.querySelector('#albumNext');
    const counter = viewer.querySelector('#currentPhoto');
    const thumbnails = viewer.querySelectorAll('.album-thumb');

    if (!track || slides.length === 0) return;

    let currentIndex = 0;
    const totalSlides = slides.length;

    let touchStartX = 0;
    let touchStartY = 0;
    let isDragging = false;

    function showSlide(index) {

        if (index < 0) {
            index = totalSlides - 1;
        }

        if (index >= totalSlides) {
            index = 0;
        }

        currentIndex = index;

        track.style.transform =
            `translate3d(-${currentIndex * 100}%, 0, 0)`;

        if (counter) {
            counter.textContent = currentIndex + 1;
        }

        thumbnails.forEach(function (thumbnail, i) {

            thumbnail.classList.toggle(
                'active',
                i === currentIndex
            );

        });

        const activeThumbnail = thumbnails[currentIndex];

        if (activeThumbnail) {

            activeThumbnail.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'center'
            });

        }

    }


    // Tombol sebelumnya

    if (prevButton) {

        prevButton.addEventListener('click', function () {

            showSlide(currentIndex - 1);

        });

    }


    // Tombol berikutnya

    if (nextButton) {

        nextButton.addEventListener('click', function () {

            showSlide(currentIndex + 1);

        });

    }


    // Klik thumbnail

    thumbnails.forEach(function (thumbnail) {

        thumbnail.addEventListener('click', function () {

            const index = Number(this.dataset.index);

            if (Number.isInteger(index)) {

                showSlide(index);

            }

        });

    });


    // Navigasi keyboard

    viewer.addEventListener('keydown', function (event) {

        if (event.key === 'ArrowLeft') {

            showSlide(currentIndex - 1);

        }

        if (event.key === 'ArrowRight') {

            showSlide(currentIndex + 1);

        }

    });


    // Swipe pada layar sentuh

    track.addEventListener('touchstart', function (event) {

        touchStartX = event.changedTouches[0].screenX;
        touchStartY = event.changedTouches[0].screenY;
        isDragging = true;

    }, { passive: true });


    track.addEventListener('touchend', function (event) {

        if (!isDragging) return;

        isDragging = false;

        const touchEndX = event.changedTouches[0].screenX;
        const touchEndY = event.changedTouches[0].screenY;

        const distanceX = touchEndX - touchStartX;
        const distanceY = touchEndY - touchStartY;

        // Abaikan jika gerakan lebih dominan vertikal.
        if (Math.abs(distanceX) < 45 ||
            Math.abs(distanceX) < Math.abs(distanceY)) {
            return;
        }

        if (distanceX < 0) {

            showSlide(currentIndex + 1);

        } else {

            showSlide(currentIndex - 1);

        }

    }, { passive: true });


    // Tampilkan foto pertama

    showSlide(0);

});
</script>

@endsection
