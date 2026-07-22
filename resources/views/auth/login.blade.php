<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <!-- Ultra-Professional Custom Styling -->
    <style>
        :root {
            --primary-emerald: #045c42;
            --dark-emerald: #023828;
            --accent-gold: #d4af37;
            --light-gold: #fef9e7;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #0f172a;
            background-image:
                radial-gradient(at 0% 0%, rgba(4, 92, 66, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(212, 175, 55, 0.1) 0px, transparent 50%),
                radial-gradient(#1e293b 1px, transparent 1px);
            background-size: 100% 100%, 100% 100%, 32px 32px;
            min-height: 100vh;
        }
        .auth-page .card {
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.05);
            overflow: hidden;
            background: #ffffff;
        }
        .auth-side-wrapper {
            background: linear-gradient(145deg, var(--dark-emerald) 0%, var(--primary-emerald) 100%);
            position: relative;
            min-height: 100%;
            padding: 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }
        .auth-side-wrapper::before {
            content: "";
            position: absolute;
            top: -25%;
            right: -25%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .auth-side-wrapper::after {
            content: "";
            position: absolute;
            bottom: -10%;
            left: -10%;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }
        .auth-side-content {
            position: relative;
            z-index: 2;
            margin: auto 0;
        }
        .badge-portal {
            display: inline-block;
            background: rgba(212, 175, 55, 0.15);
            color: #fede88;
            border: 1px solid rgba(212, 175, 55, 0.3);
            padding: 0.35rem 0.85rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 1.25rem;
        }
        .auth-side-wrapper h2 {
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #ffffff;
            font-size: 2.1rem;
            line-height: 1.25;
            margin-bottom: 1rem;
        }
        .auth-side-wrapper p {
            color: #d1fae5;
            font-size: 0.95rem;
            line-height: 1.7;
            font-weight: 300;
            opacity: 0.9;
        }
        .auth-form-wrapper {
            padding: 4rem 3.5rem !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        .brand-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--dark-emerald);
            letter-spacing: -0.5px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .brand-title span {
            color: var(--accent-gold);
        }
        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-group-custom .feather {
            position: absolute;
            left: 1rem;
            color: #94a3b8;
            width: 18px;
            height: 18px;
            transition: color 0.2s ease;
            pointer-events: none;
        }
        .form-control-custom {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.8rem;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            font-size: 0.95rem;
            color: var(--text-dark);
            background-color: #f8fafc;
            transition: all 0.2s ease-in-out;
        }
        .form-control-custom:focus {
            outline: none;
            background-color: #ffffff;
            border-color: var(--primary-emerald);
            box-shadow: 0 0 0 4px rgba(4, 92, 66, 0.1);
        }
        .form-control-custom:focus + .feather,
        .input-group-custom:focus-within .feather {
            color: var(--primary-emerald);
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-emerald) 0%, var(--dark-emerald) 100%);
            border: none;
            padding: 0.9rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            color: #ffffff;
            letter-spacing: 0.3px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            box-shadow: 0 10px 15px -3px rgba(4, 92, 66, 0.25), 0 4px 6px -2px rgba(4, 92, 66, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #057a58 0%, var(--primary-emerald) 100%);
            transform: translateY(-2px);
            box-shadow: 0 15px 20px -3px rgba(4, 92, 66, 0.35), 0 6px 8px -2px rgba(4, 92, 66, 0.15);
            color: #ffffff;
        }
        .btn-primary-custom:active {
            transform: translateY(0);
        }
        .form-check-input {
            width: 1.1em;
            height: 1.1em;
            margin-top: 0.15em;
            border-color: #cbd5e1;
        }
        .form-check-input:checked {
            background-color: var(--primary-emerald);
            border-color: var(--primary-emerald);
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
        @media (max-width: 767.98px) {
            .auth-side-wrapper {
                padding: 2.5rem 1.5rem;
                text-align: center;
            }
            .auth-form-wrapper {
                padding: 2.5rem 1.5rem !important;
            }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-10 col-xl-8 mx-auto">
                        <div class="card">
                            <div class="row g-0">
                                <!-- Left Side Banner (Branding) -->
                                <div class="col-md-5 pe-md-0 d-flex flex-column">
                                    <div class="auth-side-wrapper">
                                        <div class="auth-side-content">
                                            <span class="badge-portal">Portal Manajemen Resmi</span>
                                            <h2>MA Miftahul Midad</h2>
                                            <p class="mb-0">Selamat datang di Sistem Informasi Manajemen dan Portal Akademik. Silakan masuk untuk mengakses layanan portal web dan administrasi lembaga.</p>
                                        </div>
                                        <div class="mt-4 pt-3 border-top border-light border-opacity-10 d-none d-md-block" style="z-index: 2;">
                                            <small class="text-white text-opacity-50" style="font-size: 0.75rem;">
                                                &copy; {{ date('Y') }} MA Miftahul Midad.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Side (Interactive Form) -->
                                <div class="col-md-7 ps-md-0">
                                    <div class="auth-form-wrapper">
                                        <div class="mb-4 pb-2">
                                            <a href="{{ route('home') }}" class="brand-title mb-1">
                                                {{ $siteTitle }} <span>.</span>
                                            </a>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">Masukan kredensial akun Anda untuk melangkah ke panel kontrol.</p>
                                        </div>

                                        <!-- Session Status / Alert -->
                                        <x-auth-session-status class="mb-4 alert alert-success border-0 bg-success bg-opacity-10 text-success py-2 px-3 rounded-3" style="font-size: 0.85rem;" :status="session('status')" />

                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <!-- Email Address -->
                                            <div class="mb-4">
                                                <label for="email" class="form-label">Alamat Email</label>
                                                <div class="input-group-custom">
                                                    <i data-feather="mail" class="feather"></i>
                                                    <input type="email" class="form-control-custom @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@mamiftahulmidad.sch.id">
                                                </div>
                                                @error('email')
                                                    <div class="text-danger mt-1" style="font-size: 0.8rem; font-weight: 500;">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Password -->
                                            <div class="mb-4">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <label for="password" class="form-label mb-0">Kata Sandi</label>
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa Kata Sandi?</a>
                                                    @endif
                                                </div>
                                                <div class="input-group-custom mt-1">
                                                    <i data-feather="lock" class="feather"></i>
                                                    <input type="password" class="form-control-custom @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password" placeholder="••••••••••••">
                                                </div>
                                                @error('password')
                                                    <div class="text-danger mt-1" style="font-size: 0.8rem; font-weight: 500;">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Remember Me -->
                                            <div class="form-check mb-4 pt-1">
                                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                                <label class="form-check-label text-muted" for="remember_me" style="font-size: 0.85rem; padding-top: 2px; cursor: pointer;">
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
