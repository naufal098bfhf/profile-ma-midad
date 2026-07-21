<!-- Custom Style untuk UI Premium & Modern -->
<style>
    /* Efek Glassmorphism pada Navbar */
    .navbar-premium {
        background: rgba(255, 255, 255, 0.92) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(229, 231, 235, 0.6);
        transition: all 0.3s ease-in-out;
    }

    /* Transisi Logo & Efek Hover */
    .navbar-brand {
        text-decoration: none !important;
    }
    .navbar-brand img {
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .navbar-brand:hover img {
        transform: scale(1.05);
    }

    /* Styling Teks Brand (Samping Logo) */
    .brand-text-wrapper {
        line-height: 1.1;
    }
    .brand-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: #1e3a8a; /* Warna Biru Tua Elegan sesuai gambar */
        letter-spacing: 0.5px;
        margin-bottom: 3px;
        font-family: 'Arial', 'Helvetica', sans-serif;
    }
    .brand-subtitle {
        font-size: 0.75rem;
        font-weight: 600;
        color: #475569; /* Warna Abu-abu kebiruan untuk kontras yang pas */
        letter-spacing: 0.3px;
    }

    /* Penyesuaian ukuran teks untuk layar kecil (Mobile) */
    @media (max-width: 576px) {
        .brand-title {
            font-size: 0.95rem;
        }
        .brand-subtitle {
            font-size: 0.65rem;
        }
        .navbar-brand img {
            height: 50px !important;
        }
    }

    /* Tipografi & Item Navigasi */
    .navbar-nav .nav-link {
        font-weight: 500;
        font-size: 0.95rem;
        color: #4b5563 !important;
        padding: 0.6rem 1rem !important;
        margin: 0 0.15rem;
        border-radius: 8px;
        transition: all 0.25s ease;
        position: relative;
    }

    /* Efek Hover Nav Item */
    .navbar-nav .nav-link:hover {
        color: #0f172a !important;
        background-color: rgba(241, 245, 249, 0.8);
    }

    /* Indikator Status Aktif yang Elegan */
    .navbar-nav .nav-link.active {
        color: #1d4ed8 !important; /* Sesuaikan dengan warna utama merek sekolah */
        font-weight: 600;
        background-color: rgba(29, 78, 216, 0.08);
    }

    /* Tombol Toggler Mobile yang Bersih (Tanpa Border Kasar) */
    .navbar-toggler {
        border: none !important;
        padding: 0.5rem;
    }
    .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.15) !important;
    }

    /* Desain Dropdown Modern & Floating */
    .dropdown-menu-premium {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        padding: 0.5rem;
        margin-top: 0.75rem !important;
        background: #ffffff;
    }

    .dropdown-menu-premium .dropdown-item {
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        color: #334155;
        transition: all 0.2s ease;
    }

    .dropdown-menu-premium .dropdown-item:hover {
        background-color: #f8fafc;
        color: #1d4ed8;
        transform: translateX(3px);
    }

    /* Tombol Logout Khusus */
    .btn-logout-item {
        color: #ef4444 !important;
    }
    .btn-logout-item:hover {
        background-color: rgba(239, 68, 68, 0.08) !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light navbar-premium shadow-sm sticky-top py-2">
    <div class="container">
        <!-- Brand Logo & Teks -->
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}"
                 alt="MA Miftahul Midad"
                 style="height:60px; width:auto;">

            <div class="brand-text-wrapper d-flex flex-column">
                <span class="brand-title">MA MIFTAHUL MIDAD</span>
                <span class="brand-subtitle">Sumberejo • Sukodono • Lumajang</span>
            </div>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('announcements.*') ? 'active' : '' }}" href="{{ route('announcements.index') }}">Pengumuman</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}" href="{{ route('articles.index') }}">Berita</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pena-karsa.*') ? 'active' : '' }}" href="{{ route('pena-karsa.index') }}">Pena Karsa</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('galleries.*') ? 'active' : '' }}" href="{{ route('galleries.index') }}">Galeri</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
