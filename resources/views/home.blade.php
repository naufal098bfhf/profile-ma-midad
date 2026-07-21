@extends('layouts.app')

@php
    $siteTitle = \App\Models\Setting::getValue('site_title', 'MA Miftahul Midad');
    $siteSubtitle = \App\Models\Setting::getValue('site_subtitle', 'Berita dan Artikel Islami');
    $metaDescription = \App\Models\Setting::getValue('meta_description', 'Portal resmi MA Miftahul Midad yang menyajikan berita, pengumuman, dan informasi terbaru seputar kegiatan serta prestasi madrasah.');
    $siteLogo = \App\Models\Setting::getValue('site_logo');
@endphp
@section('title', $siteTitle . ' - ' . $siteSubtitle)
@section('description', $metaDescription)

@push('styles')
<!-- Additional Open Graph Meta Tags for Homepage -->
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $siteTitle }} - {{ $siteSubtitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ url('/') }}">
@if(!empty($siteLogo))
    <meta property="og:image" content="{{ $siteLogo }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/png">
@endif
<meta property="og:locale" content="id_ID">

<!-- Twitter Card Meta Tags for Homepage -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $siteTitle }} - {{ $siteSubtitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
@if(!empty($siteLogo))
    <meta name="twitter:image" content="{{ $siteLogo }}">
@endif
@endpush

@section('content')
<!-- Hero Banner Section -->
@include('components.hero-banner')

<!-- Announcements Widget -->
@include('components.announcements-widget')

<!-- PPDB Widget -->
@include('components.ppdb-widget')

<!-- Gallery Widget -->
@include('components.gallery-widget')

<!-- Teacher Widget -->
@include('components.teacher-widget')

<!-- Articles Section -->
<div class="articles-widget py-5 bg-white">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="widget-header d-flex justify-content-between align-items-center border-bottom pb-3">
                    <h3 class="widget-title mb-0 fw-bold" style="color: #1E3A8A;">
                        <i class="fas fa-newspaper me-2" style="color: #2563EB;"></i>
                        Berita Seputar Madrasah
                    </h3>
                    @if($articles && count($articles) > 0)
                    <a href="{{ route('articles.index') }}" class="btn btn-outline-primary rounded-pill px-4 bg-white shadow-sm" style="border-color: #BFDBFE;">
                        Semua Berita <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>

    <div class="row">
        @if($articles && count($articles) > 0)
            @foreach($articles as $article)
            <div class="col-md-4 mb-4">
                <article class="card h-100 shadow-sm border-0 rounded-4 bg-white" itemscope itemtype="https://schema.org/Article">
                    <div class="article-image-container rounded-top-4 overflow-hidden">
                        @if($article->image)
                            <img src="{{ $article->image }}" class="card-img-top article-image" alt="{{ $article->title }}" itemprop="image">
                        @else
                            <div class="article-placeholder">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column p-4">
                        <div class="mb-2">
                            <div class="entry-taxonomies">
                                <span class="category-links term-links category-style-normal">
                                    @foreach($article->categories as $category)
                                        <a href="{{ route('category.show', $category->slug) }}" class="text-decoration-none fw-bold" style="color: #2563EB; font-size: 0.85rem;" rel="tag" @if($loop->first) itemprop="articleSection" @endif>{{ strtoupper($category->name) }}</a>@if(!$loop->last) | @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>
                        <h4 class="card-title fw-bold" itemprop="headline">
                            <a href="{{ route('article.detail', $article->slug) }}" class="text-dark text-decoration-none" itemprop="mainEntityOfPage url">{{ $article->title }}</a>
                        </h4>
                        <div class="entry-meta entry-meta-divider-dot mt-auto pt-3 text-muted border-top" style="font-size: 0.85rem; border-color: #F1F5F9 !important;">
                            <span class="posted-by me-3 d-flex align-items-center">
                                <i class="fas fa-user-circle me-1" style="color: #94A3B8;"></i>
                                <span class="author vcard" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                    <a class="url fn n text-muted text-decoration-none" href="{{ route('author.show', $article->author->slug ?? '') }}" itemprop="url">
                                        <span itemprop="name">{{ $article->author->name ?? 'Unknown' }}</span>
                                    </a>
                                </span>
                            </span>
                            <span class="posted-on mt-2 d-inline-block">
                                <i class="fas fa-calendar-alt me-1" style="color: #94A3B8;"></i>
                                <time class="entry-date published" datetime="{{ $article->published_at->format('Y-m-d') }}" itemprop="datePublished">{{ $article->published_at->format('d M Y') }}</time>
                            </span>
                        </div>
                        <div class="visually-hidden" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                            <meta itemprop="name" content="{{ config('app.name') }}">
                            <meta itemprop="url" content="{{ url('/') }}">
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        @else
            <!-- Empty State Placeholder -->
            <div class="col-12">
                <div class="empty-state bg-white shadow-sm border-0 rounded-4">
                    <div class="empty-state-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h4 class="empty-state-title">Belum Ada Berita</h4>
                    <p class="empty-state-description">
                        Saat ini belum ada berita yang tersedia. Silakan kembali lagi nanti untuk melihat berita terbaru.
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>
</div>

<!-- Pena Karsa Section -->
<div class="pena-karsa-widget py-5">
    <div class="container position-relative z-index-1">
        <!-- Header Custom like Design -->
        <div class="row align-items-center mb-5">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <div class="pk-icon-badge me-4">
                        <i class="fas fa-pen" style="color: #0047E1;"></i>
                    </div>
                    <div>
                        <h2 class="pk-title-main mb-1">Pena Karsa</h2>
                        <p class="pk-subtitle-main mb-2">Kumpulan opini dan karya terbaik dari para penulis</p>
                        <div class="pk-title-underline"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-4 mt-md-0">
                @if($penaKarsa && count($penaKarsa) > 0)
                <a href="{{ route('pena-karsa.index') }}" class="btn rounded-pill px-4 pk-btn-all">
                    Semua Karya <i class="fas fa-arrow-right ms-2"></i>
                </a>
                @endif
            </div>
        </div>

        <div class="row">
            @forelse($penaKarsa as $item)
            <div class="col-md-4 mb-4">
                <!-- Card Style -->
                <article class="card pk-card h-100 border-0" itemscope itemtype="https://schema.org/Article">
                    <!-- Image Inset Container -->
                    <div class="pk-image-wrapper p-3 pb-0 position-relative bg-white rounded-top-4">
                        <div class="position-relative overflow-hidden rounded-4" style="height: 220px; background-color: #F8F9FA; border: 1px solid #F1F5F9;">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-100 h-100 pk-image" style="object-fit: cover;" alt="{{ $item->title }}" itemprop="image">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                    <h2 class="mb-0 fw-bold opacity-25">No Image</h2>
                                </div>
                            @endif

                            <!-- Badges Absolute Top Left & Right -->
                            <div class="pk-badges position-absolute top-0 start-0 w-100 p-3 d-flex justify-content-between align-items-start">
                                <span class="badge pk-badge-category rounded-pill px-3 py-2 text-white">{{ strtoupper($item->type_display) }}</span>

                                @if($item->is_featured)
                                <div class="pk-badge-featured rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; color: #FBBF24;">
                                    <i class="fas fa-star"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 bg-white rounded-bottom-4 d-flex flex-column">
                        <!-- Author Area -->
                        <div class="pk-author-info mb-3 d-flex align-items-center text-dark fw-bold">
                            <i class="fas fa-user-circle fs-5 me-2" style="color: #0047E1;"></i>
                            <span class="author-name">{{ $item->author_name }}</span>
                            <span class="text-muted ms-2 fw-normal" style="font-size: 0.85rem;">
                                @if($item->author_type === 'student' && $item->author_class)
                                    ({{ $item->author_class }})
                                @elseif($item->author_type === 'teacher' && $item->author_position)
                                    ({{ $item->author_position }})
                                @else
                                    (0)
                                @endif
                            </span>
                        </div>

                        <!-- Title & Excerpt -->
                        <h4 class="card-title fw-bold mb-2 pk-article-title" itemprop="headline">
                            <a href="{{ route('pena-karsa.show', $item->slug) }}" class="text-decoration-none stretched-link" itemprop="mainEntityOfPage url">{{ $item->title }}</a>
                        </h4>
                        <p class="card-text text-muted mb-4 pk-excerpt line-clamp-2">
                            {{ Str::limit(strip_tags($item->excerpt), 80) }}
                        </p>

                        <!-- Tags (Pills) -->
                        @php
                            $cleanTags = $item->getCleanTags();
                        @endphp
                        @if(count($cleanTags) > 0)
                        <div class="pk-tags mb-4">
                            @foreach(array_slice($cleanTags, 0, 3) as $tag)
                                <span class="badge rounded-pill fw-bold px-3 py-2 me-1 mb-1 pk-tag-pill">{{ $tag }}</span>
                            @endforeach
                            @if(count($cleanTags) > 3)
                                <span class="badge rounded-pill fw-bold px-3 py-2 mb-1 pk-tag-pill">...</span>
                            @endif
                        </div>
                        @endif

                        <!-- Footer (Date & Views) -->
                        <div class="mt-auto pt-3 border-top pk-footer d-flex justify-content-between align-items-center text-muted">
                            <div class="pk-date">
                                <i class="fas fa-calendar-alt me-2" style="color: #0047E1;"></i>
                                <time class="entry-date published" datetime="{{ $item->published_at->format('Y-m-d') }}" itemprop="datePublished">{{ $item->published_at->format('d M Y') }}</time>
                            </div>
                            <div class="pk-views fw-bold">
                                <i class="fas fa-eye me-2" style="color: #0047E1;"></i>
                                {{ number_format($item->views) }}
                            </div>
                        </div>

                        <div class="visually-hidden" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                            <meta itemprop="name" content="{{ config('app.name') }}">
                            <meta itemprop="url" content="{{ url('/') }}">
                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5 empty-state shadow-sm rounded-4 border-0 bg-white">
                    <i class="fas fa-pen-fancy fa-3x text-muted mb-3 opacity-25"></i>
                    <h4 class="text-muted fw-bold">Belum ada tulisan</h4>
                    <p class="text-muted">Karya tulisan terbaik akan muncul di sini ketika tersedia.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
/* ========================================================
   GLOBAL ARTICLE WIDGET
   ======================================================== */
.article-image-container {
    position: relative;
    height: 220px;
    background-color: #f8f9fa;
}
.article-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.card:hover .article-image {
    transform: scale(1.05);
}
.article-placeholder {
    height: 100%;
    background: linear-gradient(135deg, #E2E8F0, #F8FAFC);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94A3B8;
}
.article-placeholder i {
    font-size: 3rem;
}
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: #ffffff;
    border-radius: 1rem;
    margin: 2rem 0;
}
.empty-state-icon i {
    font-size: 4rem;
    color: #CBD5E1;
    margin-bottom: 1.5rem;
}

/* ========================================================
   PENA KARSA SECTION (Dominan Putih Selaras)
   ======================================================== */
.pena-karsa-widget {
    background-color: #ffffff; /* Latar belakang utama putih */
    position: relative;
    overflow: hidden;
}

/* Dekorasi background minimalis untuk mengurangi kesan kaku */
.pena-karsa-widget::before {
    content: '';
    position: absolute;
    top: -100px;
    right: -100px;
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(240, 245, 255, 0.6) 0%, rgba(255,255,255,0) 65%);
    z-index: 0;
    pointer-events: none;
}
.pena-karsa-widget::after {
    content: '';
    position: absolute;
    bottom: 40px;
    right: 40px;
    width: 150px;
    height: 150px;
    background-image: radial-gradient(#E2E8F0 2px, transparent 2px);
    background-size: 20px 20px;
    opacity: 0.5;
    z-index: 0;
    pointer-events: none;
}
.z-index-1 {
    z-index: 1;
}

/* Header UI */
.pk-icon-badge {
    width: 75px;
    height: 75px;
    background-color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1); /* Bayangan biru halus */
}
.pk-title-main {
    color: #1E3A8A; /* Navy blue elegan */
    font-family: 'Georgia', serif;
    font-weight: 800;
    font-size: 2rem;
}
.pk-subtitle-main {
    color: #64748B;
    font-size: 0.95rem;
}
.pk-title-underline {
    width: 60px;
    height: 3px;
    background-color: #2563EB;
    border-radius: 2px;
}
.pk-btn-all {
    background-color: #ffffff;
    border: 1px solid #BFDBFE;
    color: #2563EB;
    font-weight: 600;
    transition: all 0.3s;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}
.pk-btn-all:hover {
    background-color: #EFF6FF;
    border-color: #2563EB;
    color: #1D4ED8;
    transform: translateY(-2px);
}

/* Card UI */
.pk-card {
    border-radius: 1.25rem !important;
    background-color: #ffffff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); /* Soft shadow agar pop out dari background putih */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.pk-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.02) !important;
}

/* Image & Badges */
.pk-badge-category {
    background-color: #0047E1 !important; /* Vivid Blue */
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 10px rgba(0, 71, 225, 0.2);
}

/* Typography Inside Card */
.pk-article-title a {
    color: #0F172A !important;
    font-size: 1.25rem;
    transition: color 0.2s;
    font-family: 'Georgia', serif;
}
.pk-article-title a:hover {
    color: #2563EB !important;
}
.pk-excerpt {
    font-size: 0.9rem;
    line-height: 1.5;
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Tags */
.pk-tag-pill {
    background-color: #F0F5FF !important;
    color: #2563EB !important;
    font-size: 0.75rem;
}

/* Footer */
.pk-footer {
    border-top-color: #F1F5F9 !important;
    font-size: 0.85rem;
}
</style>
@endsection
