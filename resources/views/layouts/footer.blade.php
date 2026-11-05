
<footer class="bg-white border-top py-4 mt-4">
    <div class="container">
        @php
            $contactAddress = \App\Models\Setting::getValue(
                'contact_address',
                'Jl. Musi No.17 Sumberejo - Sukodono - Lumajang'
            );

            $contactEmail = \App\Models\Setting::getValue(
                'contact_email',
                'masmiftahulmidad95@gmail.com'
            );

            $contactWhatsapp = \App\Models\Setting::getValue(
                'contact_whatsapp',
                '0878 2413 8050'
            );

            $siteTitle = \App\Models\Setting::getValue(
                'site_title',
                config('app.name', 'MA Miftahul Midad')
            );

          // Media Sosial MA Miftahul Midad
$facebook = \App\Models\Setting::getValue(
    'social_facebook',
    'https://www.facebook.com/mas.miftahulmidad'
);

$youtube = \App\Models\Setting::getValue(
    'social_youtube',
    'https://www.youtube.com/@masmiftahulmidad'
);

$tiktok = \App\Models\Setting::getValue(
    'social_tiktok',
    'https://www.tiktok.com/@mamiftahulmidad'
);

$instagram = \App\Models\Setting::getValue(
    'social_instagram',
    'https://www.instagram.com/masmiftahulmidad_'
);
        @endphp

        <div class="row">

            <!-- MENU CEPAT -->
            <div class="col-md-3 col-6 mb-4">
                <h6 class="footer-title">Menu Cepat</h6>

                <ul class="footer-links">
                    <li>
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('announcements.index') }}">Pengumuman</a>
                    </li>
                    <li>
                        <a href="{{ route('galleries.index') }}">Galeri</a>
                    </li>
                    <li>
                        <a href="{{ route('articles.index') }}">Berita</a>
                    </li>
                </ul>
            </div>

            <!-- KATEGORI PENGUMUMAN -->
            <div class="col-md-3 col-6 mb-4">
                <h6 class="footer-title">Kategori Pengumuman</h6>

                <ul class="footer-links">
                    <li>
                        <a href="{{ route('announcements.index', ['category' => 'ujian']) }}">Ujian</a>
                    </li>
                    <li>
                        <a href="{{ route('announcements.index', ['category' => 'libur']) }}">Libur</a>
                    </li>
                    <li>
                        <a href="{{ route('announcements.index', ['category' => 'umum']) }}">Umum</a>
                    </li>
                </ul>
            </div>

            <!-- KONTAK -->
            <div class="col-md-3 col-12 mb-4">
                <h6 class="footer-title">Kontak</h6>

                <div class="footer-contact">

                    <p class="mb-2">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $contactAddress }}
                    </p>

                    <p class="mb-2">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ $contactEmail }}">
                            {{ $contactEmail }}
                        </a>
                    </p>

                    <p class="mb-0">
                        <i class="fab fa-whatsapp"></i>
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $contactWhatsapp) }}"
                           target="_blank"
                           rel="noopener noreferrer">
                            {{ $contactWhatsapp }}
                        </a>
                    </p>

                </div>
            </div>

            <!-- MEDIA SOSIAL -->
            <div class="col-md-3 col-12 mb-4">
                <h6 class="footer-title">Ikuti Kami</h6>

                <p class="footer-social-text">
                    Ikuti media sosial kami untuk mendapatkan informasi dan dokumentasi kegiatan madrasah.
                </p>

                <div class="footer-social">

                    @if($facebook)
                        <a href="{{ $facebook }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="social-icon facebook"
                           aria-label="Facebook"
                           title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif

                    @if($youtube)
                        <a href="{{ $youtube }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="social-icon youtube"
                           aria-label="YouTube"
                           title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif

                    @if($tiktok)
                        <a href="{{ $tiktok }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="social-icon tiktok"
                           aria-label="TikTok"
                           title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    @endif

                    @if($instagram)
                        <a href="{{ $instagram }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="social-icon instagram"
                           aria-label="Instagram"
                           title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif

                </div>

                @if(!$facebook && !$youtube && !$tiktok && !$instagram)
                    <small class="text-muted">
                        Media sosial belum tersedia.
                    </small>
                @endif

            </div>

        </div>

        <hr class="my-3">

        <!-- COPYRIGHT -->
        <div class="row">
            <div class="col-12 text-center">
                <small class="text-muted">
                    &copy; {{ date('Y') }} Naufal H Dev. All Rights Reserved.
                </small>
            </div>
        </div>

    </div>
</footer>

<style>
    .footer-title {
        font-size: 15px;
        font-weight: 700;
        color: #263238;
        margin-bottom: 18px;
        position: relative;
        padding-bottom: 9px;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 35px;
        height: 2px;
        background: #03aca5;
        border-radius: 5px;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 10px;
    }

    .footer-links a {
        color: #68757c;
        text-decoration: none;
        font-size: 13px;
        transition: all .25s ease;
    }

    .footer-links a:hover {
        color: #03aca5;
        padding-left: 4px;
    }

    .footer-contact p {
        color: #68757c;
        font-size: 13px;
        line-height: 1.7;
        display: flex;
        align-items: flex-start;
        gap: 9px;
    }

    .footer-contact p > i {
        color: #03aca5;
        margin-top: 4px;
        min-width: 15px;
    }

    .footer-contact a {
        color: #68757c;
        text-decoration: none;
        transition: color .25s ease;
    }

    .footer-contact a:hover {
        color: #03aca5;
    }

    .footer-social-text {
        color: #68757c;
        font-size: 13px;
        line-height: 1.7;
        margin-bottom: 16px;
    }

    .footer-social {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .social-icon {
        width: 39px;
        height: 39px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f1f5f5;
        color: #526168;
        font-size: 16px;
        text-decoration: none;
        transition: all .3s ease;
        border: 1px solid #e8eeee;
    }

    .social-icon:hover {
        color: #fff;
        transform: translateY(-4px);
        box-shadow: 0 5px 14px rgba(0,0,0,.15);
    }

    .social-icon.facebook:hover {
        background: #1877f2;
        border-color: #1877f2;
    }

    .social-icon.youtube:hover {
        background: #ff0000;
        border-color: #ff0000;
    }

    .social-icon.tiktok:hover {
        background: #111111;
        border-color: #111111;
    }

    .social-icon.instagram:hover {
        background: linear-gradient(45deg, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5);
        border-color: transparent;
    }

    @media (max-width: 767px) {
        footer .row {
            row-gap: 12px;
        }

        .footer-social {
            gap: 12px;
        }

        .social-icon {
            width: 42px;
            height: 42px;
        }
    }
</style>
