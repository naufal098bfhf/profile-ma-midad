<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Portal Resmi dan Sistem Manajemen MA Miftahul Midad">
    <meta name="author" content="MA Miftahul Midad">

    @php
        $siteTitle = \App\Models\Setting::getValue('site_title', 'MA Miftahul Midad');
    @endphp

    <title>Login Sistem - {{ $siteTitle }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/core/core.css') }}">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('template/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/demo1/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('template/assets/images/favicon.png') }}" />

    <!-- Ultra-Professional Custom Styling (Conflict-Free) -->
    <style>
        :root {
            --primary-emerald: #045c42;
            --primary-hover: #034833;
            --dark-emerald: #022c1f;
            --accent-gold: #d4af37;
            --light-gold: #fef9e7;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --bg-input: #f8fafc;
        }

        * {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Override Template Backgrounds */
        body, html, .main-wrapper, .page-wrapper, .page-content {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
            background-color: #0b1120 !important;
            background-image:
                radial-gradient(at 0% 0%, rgba(4, 92, 66, 0.3) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(212, 175, 55, 0.15) 0px, transparent 50%),
                linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px) !important;
            background-size: 100% 100%, 100% 100%, 32px 32px, 32px 32px !important;
            background-position: 0 0, 0 0, -1px -1px, -1px -1px !important;
            min-height: 100vh !important;
            margin: 0;
        }

        .page-content {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 2rem 1rem !important;
            min-height: 100vh !important;
        }

        /* Card Container */
        .auth-page .card {
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: 24px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05) !important;
            overflow: hidden !important;
            background: #ffffff !important;
            width: 100%;
            transition: all 0.3s ease;
        }

        /* Left Side Banner (Branding) - Force Dark Gradient */
        .custom-auth-banner {
            background: linear-gradient(135deg, #022c1f 0%, #045c42 55%, #087f5b 100%) !important;
            position: relative;
            height: 100%;
            padding: 3.5rem 3rem !important;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            z-index: 1;
        }

        .custom-auth-banner::before {
            content: "";
            position: absolute;
            top: -20%;
            right: -20%;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.25) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: -1;
        }

        .custom-auth-banner::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.6;
            pointer-events: none;
            z-index: -1;
        }

        .badge-portal {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(212, 175, 55, 0.2) !important;
            color: #fede88 !important;
            border: 1px solid rgba(212, 175, 55, 0.4) !important;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            width: fit-content;
        }

        .custom-auth-banner h2 {
            font-weight: 800 !important;
            letter-spacing: -0.8px;
            color: #ffffff !important;
            font-size: 2.2rem !important;
            line-height: 1.25 !important;
            margin-bottom: 1rem !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .custom-auth-banner p {
            color: #f1f5f9 !important;
            font-size: 0.95rem !important;
            line-height: 1.7 !important;
            font-weight: 400;
            opacity: 0.9;
        }

        /* Right Side Form */
        .auth-form-wrapper {
            padding: 4rem 3.5rem !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            background-color: #ffffff !important;
        }

        .brand-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--dark-emerald);
            letter-spacing: -0.5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .brand-title span {
            color: var(--accent-gold);
            font-size: 2rem;
            line-height: 0;
            margin-left: 2px;
        }

        .form-label {
            font-weight: 700 !important;
            font-size: 0.75rem !important;
            color: var(--text-dark) !important;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 0.5rem;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group-custom .feather {
            position: absolute;
            left: 1.15rem;
            color: #94a3b8;
            width: 18px;
            height: 18px;
            transition: all 0.25s ease;
            pointer-events: none;
            z-index: 4;
        }

        .form-control-custom {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 3.2rem !important;
            border-radius: 12px !important;
            border: 1.5px solid var(--border-color) !important;
            font-size: 0.92rem !important;
            font-weight: 500;
            color: var(--text-dark) !important;
            background-color: var(--bg-input) !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control-custom::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .form-control-custom:hover {
            border-color: #cbd5e1 !important;
            background-color: #f1f5f9 !important;
        }

        .form-control-custom:focus {
            outline: none !important;
            background-color: #ffffff !important;
            border-color: var(--primary-emerald) !important;
            box-shadow: 0 0 0 4px rgba(4, 92, 66, 0.12) !important;
        }

        .form-control-custom:focus + .feather,
        .input-group-custom:focus-within .feather {
            color: var(--primary-emerald);
            transform: scale(1.1);
        }

        .form-control-custom.is-invalid {
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }

        .form-control-custom.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12) !important;
        }

        /* Button Custom */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-emerald) 0%, var(--dark-emerald) 100%) !important;
            border: none !important;
            padding: 0.95rem 1.5rem !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            font-size: 0.95rem !important;
            color: #ffffff !important;
            letter-spacing: 0.4px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            box-shadow: 0 10px 20px -5px rgba(4, 92, 66, 0.4), 0 4px 6px -2px rgba(4, 92, 66, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.6rem;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary-custom:hover::after {
            left: 100%;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #056e4f 0%, var(--primary-emerald) 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(4, 92, 66, 0.5), 0 8px 10px -6px rgba(4, 92, 66, 0.2);
            color: #ffffff !important;
        }

        .btn-primary-custom:active {
            transform: translateY(0);
            box-shadow: 0 5px 10px -3px rgba(4, 92, 66, 0.4);
        }

        /* Checkbox & Links */
        .form-check-input {
            width: 1.15em;
            height: 1.15em;
            margin-top: 0.12em;
            border: 1.5px solid #cbd5e1 !important;
            border-radius: 6px !important;
            cursor: pointer;
            transition: all 0.2s;
        }

        .form-check-input:checked {
            background-color: var(--primary-emerald) !important;
            border-color: var(--primary-emerald) !important;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(4, 92, 66, 0.15) !important;
        }

        .forgot-link {
            color: var(--primary-emerald);
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--dark-emerald);
            text-decoration: underline;
        }

        /* Responsive Breakpoints */
        @media (max-width: 1199.98px) {
            .auth-form-wrapper {
                padding: 3rem 2.5rem !important;
            }
            .custom-auth-banner {
                padding: 3rem 2.5rem !important;
            }
        }

        @media (max-width: 767.98px) {
            .page-content {
                padding: 1rem !important;
                align-items: flex-start !important;
            }
            .auth-page .card {
                border-radius: 20px !important;
            }
            .custom-auth-banner {
                padding: 2.5rem 1.75rem !important;
                text-align: center;
                align-items: center;
            }
            .custom-auth-banner::before,
            .custom-auth-banner::after {
                display: none;
            }
            .custom-auth-banner h2 {
                font-size: 1.75rem !important;
            }
            .auth-form-wrapper {
                padding: 2.5rem 1.75rem !important;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper w-100">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center w-100">

                <div class="row w-100 mx-0 auth-page justify-content-center">
                    <div class="col-12 col-sm-11 col-md-11 col-lg-10 col-xl-8 px-0 px-sm-2">
                        <div class="card">
                            <div class="row g-0">
                                <!-- Left Side Banner (Branding) -->
                                <div class="col-md-5 pe-md-0 d-flex flex-column">
                                    <div class="custom-auth-banner">
                                        <div class="auth-side-content">
                                            <div class="badge-portal">
                                                <span>Portal Manajemen Resmi</span>
                                            </div>
                                            <h2>MA Miftahul Midad</h2>
                                            <p class="mb-0">Selamat datang di Sistem Informasi Manajemen dan Portal Akademik. Silakan masuk untuk mengakses layanan portal web dan administrasi lembaga.</p>
                                        </div>
                                        <div class="mt-4 pt-4 border-top border-light border-opacity-10 d-none d-md-block" style="z-index: 2;">
                                            <small class="text-white text-opacity-75 d-block font-weight-500" style="font-size: 0.78rem;">
                                                &copy; {{ date('Y') }} MA Miftahul Midad.
                                            </small>
                                            <small class="text-white text-opacity-50" style="font-size: 0.7rem;">
                                                All rights reserved. System Version 2.0
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Side (Interactive Form) -->
                                <div class="col-md-7 ps-md-0">
                                    <div class="auth-form-wrapper">
                                        <div class="mb-4 pb-1">
                                            <a href="{{ route('home') }}" class="brand-title mb-1">
                                                {{ $siteTitle }}<span>.</span>
                                            </a>
                                            <p class="text-muted mb-0" style="font-size: 0.92rem; line-height: 1.5;">Masukan kredensial akun Anda untuk melangkah ke panel kontrol.</p>
                                        </div>

                                        <!-- Session Status / Alert -->
                                        <x-auth-session-status class="mb-4 alert alert-success border-0 bg-success bg-opacity-10 text-success py-2 px-3 rounded-3" style="font-size: 0.85rem; font-weight: 600;" :status="session('status')" />

                                        <form method="POST" action="{{ route('login') }}" novalidate>
                                            @csrf

                                            <!-- Email Address -->
                                            <div class="mb-3 pb-1">
                                                <label for="email" class="form-label">Alamat Email</label>
                                                <div class="input-group-custom">
                                                    <input type="email" class="form-control-custom @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@mamiftahulmidad.sch.id">
                                                    <i data-feather="mail" class="feather"></i>
                                                </div>
                                                @error('email')
                                                    <div class="text-danger mt-2 d-flex align-items-center gap-1" style="font-size: 0.8rem; font-weight: 600;">
                                                        <span>{{ $message }}</span>
                                                    </div>
                                                @enderror
                                            </div>

                                            <!-- Password -->
                                            <div class="mb-3 pb-1">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <label for="password" class="form-label mb-0">Kata Sandi</label>
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}" class="forgot-link" tabindex="-1">Lupa Kata Sandi?</a>
                                                    @endif
                                                </div>
                                                <div class="input-group-custom mt-1">
                                                    <input type="password" class="form-control-custom @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password" placeholder="••••••••••••">
                                                    <i data-feather="lock" class="feather"></i>
                                                </div>
                                                @error('password')
                                                    <div class="text-danger mt-2 d-flex align-items-center gap-1" style="font-size: 0.8rem; font-weight: 600;">
                                                        <span>{{ $message }}</span>
                                                    </div>
                                                @enderror
                                            </div>

                                            <!-- Remember Me -->
                                            <div class="form-check mb-4 pt-1 d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input m-0 me-2" id="remember_me" name="remember">
                                                <label class="form-check-label text-muted user-select-none" for="remember_me" style="font-size: 0.85rem; cursor: pointer;">
                                                    Tetap masuk di perangkat ini
                                                </label>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="mt-2">
                                                <button type="submit" class="btn-primary-custom">
                                                    <span>Otorisasi Masuk</span>
                                                    <i data-feather="arrow-right" style="width: 18px; height: 18px;"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Footer Copyright -->
                        <div class="text-center mt-4 d-block d-md-none">
                            <p class="text-white text-opacity-50 mb-0" style="font-size: 0.8rem;">&copy; {{ date('Y') }} {{ $siteTitle }}. All rights reserved.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('template/assets/vendors/core/core.js') }}"></script>

    <!-- inject:js -->
    <script src="{{ asset('template/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/template.js') }}"></script>

    <!-- Initialize Feather Icons -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
</body>
</html>
