<style>
/* ==========================================================
   MA MIFTAHUL MIDAD
   Public navigation | Turquoise identity
   ========================================================== */

:root {
    --madrasah-primary: #08B4AD;
    --madrasah-primary-hover: #078F89;
    --madrasah-primary-dark: #087F74;
    --madrasah-primary-soft: #E8F8F6;
    --madrasah-text: #263B3A;
    --madrasah-muted: #687C79;
    --madrasah-border: #E1EEEB;
    --madrasah-white: #FFFFFF;
    --madrasah-shadow: 0 8px 28px rgba(24, 74, 68, .075);
}

/* Main navigation bar */
.madrasah-navbar {
    position: sticky;
    top: 0;
    z-index: 1030;
    width: 100%;
    padding: 10px 0;
    background: rgba(255, 255, 255, .97);
    border-bottom: 1px solid var(--madrasah-border);
    box-shadow: 0 3px 16px rgba(24, 74, 68, .045);
    -webkit-backdrop-filter: blur(14px);
    backdrop-filter: blur(14px);
}

.madrasah-navbar .container {
    max-width: 1440px;
}

/* Brand: logo and school identity */
.madrasah-brand {
    display: inline-flex;
    align-items: center;
    gap: 11px;
    flex: 0 0 auto;
    min-width: 0;
    margin: 0;
    padding: 0;
    text-decoration: none !important;
}

.madrasah-brand-logo {
    display: block;
    width: auto;
    max-width: 58px;
    height: 52px;
    object-fit: contain;
    transition: opacity .2s ease;
}

.madrasah-brand:hover .madrasah-brand-logo {
    opacity: .88;
}

.madrasah-brand-copy {
    display: flex;
    min-width: 0;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    line-height: 1.15;
}

.madrasah-brand-title {
    color: var(--madrasah-primary-dark);
    font-family: "Inter", "Segoe UI", Arial, sans-serif;
    font-size: .98rem;
    font-weight: 800;
    letter-spacing: .2px;
    white-space: nowrap;
}

.madrasah-brand-subtitle {
    color: var(--madrasah-muted);
    font-family: "Inter", "Segoe UI", Arial, sans-serif;
    font-size: .69rem;
    font-weight: 500;
    letter-spacing: .05px;
    white-space: nowrap;
}

/* Navigation list */
.madrasah-menu {
    display: flex;
    align-items: center;
    gap: 3px;
}

.madrasah-navbar .madrasah-menu .nav-link {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 40px;
    margin: 0;
    padding: 10px 10px !important;
    border-radius: 8px;
    background: transparent;
    color: var(--madrasah-text) !important;
    font-family: "Inter", "Segoe UI", Arial, sans-serif;
    font-size: .82rem;
    font-weight: 600;
    line-height: 1.35;
    white-space: nowrap;
    transition: color .18s ease, background-color .18s ease;
}

.madrasah-navbar .madrasah-menu .nav-link:hover {
    background: #F2FAF8;
    color: var(--madrasah-primary-dark) !important;
}

.madrasah-navbar .madrasah-menu .nav-link.active {
    background: var(--madrasah-primary-soft);
    color: var(--madrasah-primary-dark) !important;
    font-weight: 750;
}

.madrasah-navbar .madrasah-menu .nav-link.active::after {
    position: absolute;
    right: 11px;
    bottom: 3px;
    left: 11px;
    height: 2px;
    border-radius: 2px;
    background: var(--madrasah-primary);
    content: "";
}

/* Action links: PPDB and RDM */
.madrasah-ppdb,
.madrasah-rdm {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 40px;
    padding: 10px 13px;
    border: 1px solid transparent;
    border-radius: 9px;
    font-family: "Inter", "Segoe UI", Arial, sans-serif;
    font-size: .81rem;
    font-weight: 750;
    line-height: 1;
    text-decoration: none !important;
    white-space: nowrap;
    transition:
        background-color .18s ease,
        border-color .18s ease,
        color .18s ease,
        box-shadow .18s ease,
        transform .18s ease;
}

.madrasah-ppdb {
    margin-left: 5px;
    background: var(--madrasah-primary);
    border-color: var(--madrasah-primary);
    color: #FFFFFF !important;
    box-shadow: 0 4px 12px rgba(8, 180, 173, .16);
}

.madrasah-ppdb:hover,
.madrasah-ppdb.active {
    transform: translateY(-1px);
    background: var(--madrasah-primary-hover);
    border-color: var(--madrasah-primary-hover);
    color: #FFFFFF !important;
    box-shadow: 0 7px 16px rgba(8, 143, 137, .19);
}

.madrasah-ppdb i,
.madrasah-rdm i {
    font-size: .92rem;
}

.madrasah-rdm {
    margin-left: 2px;
    background: #FFFFFF;
    border-color: #B9DFDA;
    color: var(--madrasah-primary-dark) !important;
}

.madrasah-rdm:hover {
    background: var(--madrasah-primary-soft);
    border-color: var(--madrasah-primary);
    color: var(--madrasah-primary-dark) !important;
}

/* Mobile menu toggle */
.madrasah-toggler {
    display: inline-flex;
    width: 42px;
    height: 42px;
    align-items: center;
    justify-content: center;
    padding: 7px;
    border: 1px solid var(--madrasah-border) !important;
    border-radius: 10px;
    background: #FFFFFF;
    box-shadow: none !important;
}

.madrasah-toggler:hover {
    background: var(--madrasah-primary-soft);
    border-color: #B9DFDA !important;
}

.madrasah-toggler:focus-visible {
    outline: 3px solid rgba(8, 180, 173, .25);
    outline-offset: 2px;
}

.madrasah-toggler .navbar-toggler-icon {
    width: 21px;
    height: 21px;
}

/* Keyboard accessibility */
.madrasah-navbar a:focus-visible {
    outline: 3px solid rgba(8, 180, 173, .3);
    outline-offset: 2px;
}

/* Tablet and mobile layout */
@media (max-width: 1199.98px) {
    .madrasah-navbar .container {
        max-width: 100%;
    }

    .madrasah-menu {
        align-items: stretch;
        gap: 4px;
        margin-top: 13px;
        padding-top: 13px;
        border-top: 1px solid var(--madrasah-border);
    }

    .madrasah-navbar .madrasah-menu .nav-link {
        width: 100%;
        min-height: 42px;
        justify-content: flex-start;
        padding: 11px 14px !important;
    }

    .madrasah-navbar .madrasah-menu .nav-link.active::after {
        top: 10px;
        bottom: 10px;
        left: 0;
        width: 3px;
        height: auto;
        border-radius: 3px;
    }

    .madrasah-ppdb,
    .madrasah-rdm {
        width: 100%;
        min-height: 43px;
        justify-content: center;
        margin: 5px 0 0;
    }

    .madrasah-ppdb {
        margin-top: 10px;
    }
}

/* Small phones */
@media (max-width: 575.98px) {
    .madrasah-navbar {
        padding: 9px 0;
    }

    .madrasah-brand {
        max-width: calc(100% - 54px);
        gap: 9px;
    }

    .madrasah-brand-logo {
        max-width: 47px;
        height: 44px;
    }

    .madrasah-brand-copy {
        gap: 4px;
    }

    .madrasah-brand-title {
        font-size: .81rem;
        letter-spacing: .05px;
        white-space: normal;
    }

    .madrasah-brand-subtitle {
        font-size: .62rem;
        white-space: normal;
    }

    .madrasah-toggler {
        width: 39px;
        height: 39px;
    }
}

/* Respect reduced-motion preferences */
@media (prefers-reduced-motion: reduce) {
    .madrasah-navbar *,
    .madrasah-navbar *::before,
    .madrasah-navbar *::after {
        transition: none !important;
        scroll-behavior: auto !important;
    }
}
</style>

<nav class="navbar navbar-expand-xl madrasah-navbar">
    <div class="container">

        {{-- Brand: logo dan identitas madrasah --}}
        <a
            class="navbar-brand madrasah-brand"
            href="{{ route('home') }}"
            aria-label="Beranda MA Miftahul Midad"
        >
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo MA Miftahul Midad"
                class="madrasah-brand-logo"
            >

            <span class="madrasah-brand-copy">
                <span class="madrasah-brand-title">MA MIFTAHUL MIDAD</span>
                <span class="madrasah-brand-subtitle">Sumberejo · Sukodono · Lumajang</span>
            </span>
        </a>

        {{-- Tombol navigasi untuk tablet dan ponsel --}}
        <button
            class="navbar-toggler madrasah-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#madrasahNavbar"
            aria-controls="madrasahNavbar"
            aria-expanded="false"
            aria-label="Buka atau tutup menu navigasi"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navigasi utama --}}
        <div class="collapse navbar-collapse" id="madrasahNavbar">
            <ul class="navbar-nav ms-auto madrasah-menu">

                {{-- 1. Beranda --}}
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}"
                        @if(request()->routeIs('home')) aria-current="page" @endif
                    >Beranda</a>
                </li>

                {{-- 2. Profil madrasah --}}
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('public.institution-profile') ? 'active' : '' }}"
                        href="{{ route('public.institution-profile') }}"
                        @if(request()->routeIs('public.institution-profile')) aria-current="page" @endif
                    >Profil</a>
                </li>

                <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('institution-history.index') ? 'active' : '' }}"
       href="{{ route('institution-history.index') }}">
        Sejarah
    </a>
</li>

                {{-- 3. Program madrasah --}}
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('programs.index') ? 'active' : '' }}"
                        href="{{ route('admin.programs.index') }}"
                        @if(request()->routeIs('programs.index')) aria-current="page" @endif
                    >Program</a>
                </li>

                {{-- 4. Berita --}}
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}"
                        href="{{ route('articles.index') }}"
                        @if(request()->routeIs('articles.*')) aria-current="page" @endif
                    >Berita</a>
                </li>

                {{-- 5. Pengumuman --}}
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('announcements.*') ? 'active' : '' }}"
                        href="{{ route('announcements.index') }}"
                        @if(request()->routeIs('announcements.*')) aria-current="page" @endif
                    >Pengumuman</a>
                </li>

                {{-- 6. Pena Karsa --}}
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('pena-karsa.*') ? 'active' : '' }}"
                        href="{{ route('pena-karsa.index') }}"
                        @if(request()->routeIs('pena-karsa.*')) aria-current="page" @endif
                    >Pena Karsa</a>
                </li>

                {{-- 7. Galeri --}}
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('galleries.*') ? 'active' : '' }}"
                        href="{{ route('galleries.index') }}"
                        @if(request()->routeIs('galleries.*')) aria-current="page" @endif
                    >Galeri</a>
                </li>

                {{-- 8. Kontak --}}
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}"
                        @if(request()->routeIs('contact')) aria-current="page" @endif
                    >Kontak</a>
                </li>

                {{-- Aksi utama: pendaftaran peserta didik --}}
                <li class="nav-item">
                    <a
                        href="{{ route('ppdb.index') }}"
                        class="madrasah-ppdb {{ request()->routeIs('ppdb.*') ? 'active' : '' }}"
                        @if(request()->routeIs('ppdb.*')) aria-current="page" @endif
                    >
                        <i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
                        <span>PPDB</span>
                    </a>
                </li>

                {{-- Akses eksternal: Rapor Digital Madrasah --}}
                <li class="nav-item">
                    <a
                        href="https://erapor.masmiftahulmidad.sch.id/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="madrasah-rdm"
                    >
                        <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                        <span>RDM</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
