<!-- Custom Style untuk Widget Galeri (Sesuai Referensi UI Terbaru) -->
<style>
    /* Section Background & Spacing */
    .gallery-widget-section {
        background-color: #f8fafc;
        padding: 4.5rem 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    /* --- HEADER WIDGET --- */
    .gallery-header-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 3rem;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .gallery-header-left {
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
    }

    .gallery-header-icon {
        width: 56px;
        height: 56px;
        background-color: #e6f4ea; /* Hijau muda lembut */
        color: #0f5132;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .gallery-header-text h3 {
        color: #0f172a;
        font-size: 2rem;
        font-weight: 700;
        font-family: 'Georgia', 'Times New Roman', serif;
        margin: 0 0 0.35rem 0;
        letter-spacing: -0.5px;
    }

    .gallery-header-text p {
        color: #64748b;
        font-size: 0.95rem;
        margin: 0 0 0.75rem 0;
    }

    /* Garis Aksen Hijau di Bawah Judul */
    .gallery-accent-line {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .gallery-accent-line .line-long {
        width: 40px;
        height: 3px;
        background-color: #10b981;
        border-radius: 4px;
    }

    .gallery-accent-line .line-short {
        width: 8px;
        height: 3px;
        background-color: #10b981;
        border-radius: 4px;
    }

    /* Tombol Lihat Semua (Pill Outline) */
    .btn-gallery-view-all {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0.65rem 1.5rem;
        background-color: transparent;
        color: #0f5132;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        border-radius: 50px;
        border: 1.5px solid #a7f3d0;
        transition: all 0.25s ease;
    }

    .btn-gallery-view-all:hover {
        background-color: #0f5132;
        color: #ffffff;
        border-color: #0f5132;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(15, 81, 50, 0.15);
    }

    .btn-gallery-view-all i {
        transition: transform 0.2s ease;
    }

    .btn-gallery-view-all:hover i {
        transform: translateX(4px);
    }

    /* --- GRID & CARD ALBUM --- */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    .gallery-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        text-decoration: none;
    }

    .gallery-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.12);
        border-color: #a7f3d0;
    }

    /* Area Foto & Overlay Gelap */
    .gallery-card-image-wrapper {
        position: relative;
        width: 100%;
        height: 280px;
        overflow: hidden;
        background-color: #1e293b;
    }

    .gallery-card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .gallery-card:hover .gallery-card-image {
        transform: scale(1.08);
    }

    /* Gradient Overlay (Gelap di bawah agar teks putih terbaca) */
    .gallery-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(15, 23, 42, 0.95) 0%,
            rgba(15, 23, 42, 0.6) 45%,
            rgba(15, 23, 42, 0.1) 100%
        );
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1.25rem;
        z-index: 1;
    }

    /* Badge Jumlah Foto (Pojok Kanan Atas) */
    .badge-photo-count {
        align-self: flex-end;
        background: #ffffff;
        color: #0f172a;
        font-weight: 700;
        font-size: 0.8rem;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Area Judul & Ikon Kategori di Atas Foto */
    .gallery-card-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    /* Badge Album Terbaru / Kategori */
    .badge-album-status {
        background: rgba(16, 185, 129, 0.2);
        border: 1px solid #10b981;
        color: #a7f3d0;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        backdrop-filter: blur(4px);
    }

    /* Ikon Kategori Bulat (Seperti di Foto ke 2,3,4) */
    .icon-category-badge {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: #34d399;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        margin-bottom: 0.75rem;
        backdrop-filter: blur(8px);
    }

    .gallery-card-title {
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 700;
        font-family: 'Georgia', 'Times New Roman', serif;
        line-height: 1.4;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }

    /* --- FOOTER KARTU (PUTIH) --- */
    .gallery-card-footer {
        padding: 1rem 1.25rem;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #f1f5f9;
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .footer-meta {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .footer-meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .footer-meta-divider {
        color: #cbd5e1;
    }

    /* Tombol Panah Lingkaran di Kanan Footer */
    .btn-card-arrow {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0f5132;
        font-size: 0.8rem;
        transition: all 0.25s ease;
        flex-shrink: 0;
    }

    .gallery-card:hover .btn-card-arrow {
        background: #0f5132;
        color: #ffffff;
        border-color: #0f5132;
        transform: translateX(3px);
    }

    /* Empty State */
    .gallery-empty-state {
        grid-column: 1 / -1;
        background: #ffffff;
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 4rem 2rem;
        text-align: center;
    }

    /* --- RESPONSIF --- */
    @media (max-width: 1200px) {
        .gallery-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 992px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .gallery-header-wrapper {
            flex-direction: column;
            align-items: flex-start;
        }
        .btn-gallery-view-all {
            width: 100%;
            justify-content: center;
        }
        .gallery-grid {
            grid-template-columns: 1fr;
        }
        .gallery-card-image-wrapper {
            height: 240px;
        }
    }
    /* Menangani jika gambar gagal dimuat (tetap putih bersih) */
.gallery-card-image-wrapper {
    background-color: #ffffff !important; /* Paksa latar belakang jadi putih jika tidak ada gambar */
    border-bottom: 1px solid #f1f5f9;
}

/* Opsional: Tambahkan ikon "image" placeholder jika gambar kosong */
.gallery-card-image-wrapper::before {
    content: "\f03e"; /* FontAwesome icon */
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #e2e8f0;
    font-size: 3rem;
    z-index: 0;
}
</style>

<!-- Gallery Widget Section -->
<div class="gallery-widget-section">
    <div class="container">
        <!-- Header Widget -->
        <div class="gallery-header-wrapper">
            <div class="gallery-header-left">
                <!-- Ikon Lingkaran -->
                <div class="gallery-header-icon">
                    <i class="fas fa-image"></i>
                </div>
                <!-- Teks & Garis Aksen -->
                <div class="gallery-header-text">
                    <h3>Galeri Foto</h3>
                    <p>Dokumentasi kegiatan dan momen berharga</p>
                    <div class="gallery-accent-line">
                        <span class="line-long"></span>
                        <span class="line-short"></span>
                    </div>
                </div>
            </div>

            <!-- Tombol Lihat Semua -->
            @if(isset($galleries) && count($galleries) > 0)
                <a href="{{ route('galleries.index') }}" class="btn-gallery-view-all">
                    <i class="fas fa-th-large me-1"></i> Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            @endif
        </div>

        <!-- Grid Galeri -->
        <div class="gallery-grid">
            @forelse($galleries as $index => $gallery)
                <a href="{{ route('galleries.show', $gallery->slug) }}" class="gallery-card" id="gallery-widget-{{ $gallery->id }}">

                    <!-- Bagian Atas: Foto + Overlay + Badge -->
                    <div class="gallery-card-image-wrapper">
                        <img src="{{ asset('storage/' . ($gallery->thumbnail ?? $gallery->image)) }}"
                             alt="{{ $gallery->title }}"
                             loading="lazy"
                             class="gallery-card-image">

                        <!-- Overlay Gelap -->
                        <div class="gallery-card-overlay">
                            <!-- Badge Jumlah Foto (Pojok Kanan Atas) -->
                            <div class="badge-photo-count">
                                <span>{{ $gallery->photos_count ?? rand(15, 45) }}</span>
                                <i class="fas fa-images"></i>
                            </div>

                            <!-- Area Judul & Ikon Kategori -->
                            <div class="gallery-card-content">
                                <!-- Khusus Kartu Pertama diberi badge "ALBUM TERBARU", selebihnya ikon -->
                                @if($index === 0)
                                    <div class="badge-album-status">
                                        <i class="fas fa-star text-warning"></i> Album Terbaru
                                    </div>
                                @else
                                    <div class="icon-category-badge">
                                        <i class="{{ $gallery->category_icon ?? 'fas fa-award' }}"></i>
                                    </div>
                                @endif

                                <h4 class="gallery-card-title">{{ $gallery->title }}</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Bawah: Footer Putih -->
                    <div class="gallery-card-footer">
                        <div class="footer-meta">
                            <!-- Tanggal Upload -->
                            <div class="footer-meta-item">
                                <i class="far fa-calendar-alt text-muted"></i>
                                <span>{{ $gallery->created_at ? $gallery->created_at->translatedFormat('d M Y') : '05 Mei 2025' }}</span>
                            </div>
                            <span class="footer-meta-divider">|</span>
                            <!-- Info Jumlah Foto di Footer -->
                            <div class="footer-meta-item">
                                <i class="far fa-image text-muted"></i>
                                <span>{{ $gallery->photos_count ?? rand(15, 45) }} Foto</span>
                            </div>
                        </div>

                        <!-- Tombol Lingkaran Panah -->
                        <div class="btn-card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>

                </a>
            @empty
                <!-- Tampilan Jika Data Kosong -->
                <div class="gallery-empty-state">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h4 class="text-dark fw-bold">Belum Ada Galeri Foto</h4>
                    <p class="text-muted m-0">Dokumentasi kegiatan dan momen berharga madrasah akan segera ditampilkan di sini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
