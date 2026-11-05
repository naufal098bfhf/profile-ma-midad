
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal Resmi dan Sistem Manajemen MA Miftahul Midad">
    <meta name="author" content="MA Miftahul Midad">

    @php
        $siteTitle = \App\Models\Setting::getValue(
            'site_title',
            'MA Miftahul Midad'
        );
    @endphp

    <title>Login - {{ $siteTitle }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/fonts/feather-font/css/iconfont.css') }}">

    <style>
        :root {
            --green: #087f68;
            --green-dark: #075b4c;
            --green-soft: #eaf5f1;
            --text: #172b27;
            --muted: #75847f;
            --border: #e5ece9;
            --background: #f5f8f7;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text);
        }

        body {
            background: var(--background);
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background:
                radial-gradient(circle at 10% 10%, rgba(8,127,104,.055), transparent 28%),
                radial-gradient(circle at 90% 90%, rgba(8,127,104,.045), transparent 28%),
                #f5f8f7;
        }

        .login-container {
            width: 100%;
            max-width: 1000px;
        }

        .login-card {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            background: #fff;
            border: 1px solid rgba(220,232,226,.9);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(22,55,43,.075);
        }

        /* BRAND PANEL */

        .brand-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 570px;
            padding: 48px 42px 35px;
            color: #fff;
            background: var(--green-dark);
            overflow: hidden;
        }

        .brand-panel::before {
            content: "";
            position: absolute;
            width: 330px;
            height: 330px;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 50%;
            top: -145px;
            right: -135px;
        }

        .brand-panel::after {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 50%;
            bottom: -120px;
            left: -100px;
        }

        .brand-content,
        .brand-footer {
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 75px;
        }

        .brand-logo img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: #fff;
            padding: 5px;
            border-radius: 12px;
        }

        .brand-logo-text {
            font-size: 13px;
            font-weight: 700;
            line-height: 1.5;
            letter-spacing: .2px;
        }

        .brand-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #c5e6dc;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 22px;
        }

        .brand-label::before {
            content: "";
            width: 22px;
            height: 2px;
            background: #a7d9c9;
        }

        .brand-panel h1 {
            font-size: clamp(27px, 3vw, 36px);
            font-weight: 800;
            line-height: 1.3;
            letter-spacing: -1.2px;
            color: #fff;
            margin-bottom: 18px;
        }

        .brand-description {
            max-width: 340px;
            color: rgba(255,255,255,.76);
            font-size: 13px;
            line-height: 1.9;
            font-weight: 400;
        }

        .brand-divider {
            height: 1px;
            background: rgba(255,255,255,.15);
            margin-bottom: 20px;
        }

        .brand-footer {
            color: rgba(255,255,255,.65);
            font-size: 10px;
            line-height: 1.8;
        }

        /* FORM PANEL */

        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 65px 65px;
            background: #fff;
        }

        .form-heading {
            margin-bottom: 35px;
        }

        .form-heading .eyebrow {
            display: block;
            color: var(--green);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.7px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .form-heading h2 {
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.8px;
            color: var(--text);
            margin-bottom: 10px;
        }

        .form-heading p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
            margin: 0;
        }

        .form-label {
            display: block;
            color: #33453f;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .field-wrapper {
            position: relative;
        }

        .field-wrapper .field-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #91a29a;
            font-size: 16px;
            pointer-events: none;
        }

        .form-control-custom {
            width: 100%;
            height: 49px;
            padding: 0 15px 0 44px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: #fbfdfc;
            color: var(--text);
            font-family: inherit;
            font-size: 12px;
            font-weight: 500;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .form-control-custom::placeholder {
            color: #a5b1ab;
            font-weight: 400;
        }

        .form-control-custom:hover {
            border-color: #cbdcd4;
        }

        .form-control-custom:focus {
            background: #fff;
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(8,127,104,.09);
        }

        .form-control-custom.is-invalid {
            border-color: #dc6262;
        }

        .field-wrapper:focus-within .field-icon {
            color: var(--green);
        }

        .forgot-link {
            color: var(--green);
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
        }

        .forgot-link:hover {
            color: var(--green-dark);
            text-decoration: underline;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 19px 0 25px;
        }

        .remember-row input {
            width: 15px;
            height: 15px;
            accent-color: var(--green);
            cursor: pointer;
        }

        .remember-row label {
            color: var(--muted);
            font-size: 11px;
            cursor: pointer;
        }

        .btn-login {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            height: 49px;
            border: none;
            border-radius: 10px;
            background: var(--green);
            color: #fff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .2px;
            cursor: pointer;
            transition: background .2s, transform .2s, box-shadow .2s;
        }

        .btn-login:hover {
            background: var(--green-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(8,127,104,.16);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-security {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            margin-top: 25px;
            color: #9aa8a1;
            font-size: 10px;
        }

        .login-security i {
            color: var(--green);
        }

        .alert-custom {
            padding: 11px 13px;
            margin-bottom: 22px;
            border: 1px solid #d5ebe0;
            border-radius: 9px;
            background: #f0faf5;
            color: #16734f;
            font-size: 11px;
            font-weight: 600;
        }

        .error-message {
            margin-top: 7px;
            color: #d14343;
            font-size: 10px;
            font-weight: 600;
        }

        .mobile-footer {
            display: none;
        }

        /* RESPONSIVE */

        @media (max-width: 767px) {
            .login-page {
                padding: 20px 14px;
                align-items: center;
            }

            .login-card {
                grid-template-columns: 1fr;
                border-radius: 17px;
            }

            .brand-panel {
                min-height: auto;
                padding: 25px 25px 27px;
            }

            .brand-logo {
                margin-bottom: 28px;
            }

            .brand-logo img {
                width: 42px;
                height: 42px;
            }

            .brand-label {
                margin-bottom: 12px;
            }

            .brand-panel h1 {
                font-size: 23px;
                margin-bottom: 10px;
            }

            .brand-description {
                font-size: 11px;
                margin-bottom: 0;
            }

            .brand-footer {
                display: none;
            }

            .form-panel {
                padding: 35px 25px 30px;
            }

            .form-heading {
                margin-bottom: 27px;
            }

            .form-heading h2 {
                font-size: 24px;
            }

            .mobile-footer {
                display: block;
                margin-top: 22px;
                color: #9aa8a1;
                font-size: 10px;
                text-align: center;
            }
        }

        @media (max-width: 380px) {
            .form-panel {
                padding: 30px 20px;
            }

            .brand-panel {
                padding: 22px 20px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition: none !important;
            }
        }
    </style>
</head>

<body>

<main class="login-page">
    <div class="login-container">

        <div class="login-card">

            <!-- BRAND PANEL -->
            <section class="brand-panel">

                <div class="brand-content">

                    <div class="brand-logo">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Logo MA Miftahul Midad"
                             onerror="this.style.display='none'">

                        <div class="brand-logo-text">
                            MA MIFTAHUL MIDAD
                            <br>
                            <span style="font-weight:400;opacity:.7;">
                                Sistem Informasi Madrasah
                            </span>
                        </div>
                    </div>

                    <div class="brand-label">
                        Portal Resmi Madrasah
                    </div>

                    <h1>
                        Selamat Datang
                        <br>
                        Kembali.
                    </h1>

                    <p class="brand-description">
                        Sistem Informasi Manajemen MA Miftahul Midad
                        sebagai pusat pengelolaan informasi,
                        administrasi, dan layanan digital madrasah.
                    </p>

                </div>

                <div class="brand-footer">
                    <div class="brand-divider"></div>
                    &copy; {{ date('Y') }} {{ $siteTitle }}.
                    <br>
                    Seluruh hak cipta dilindungi.
                </div>

            </section>

            <!-- LOGIN FORM -->
            <section class="form-panel">

                <div class="form-heading">
                    <span class="eyebrow">Administrator Access</span>
                    <h2>Masuk ke Akun</h2>
                    <p>
                        Silakan masukkan email dan kata sandi
                        untuk mengakses panel administrasi.
                    </p>
                </div>

                <!-- SESSION STATUS -->
                @if (session('status'))
                    <div class="alert-custom">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            Alamat Email
                        </label>

                        <div class="field-wrapper">
                            <i data-feather="mail" class="field-icon"></i>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control-custom @error('email') is-invalid @enderror"
                                placeholder="nama@email.com"
                                required
                                autofocus
                                autocomplete="username"
                            >
                        </div>

                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="password" class="form-label mb-0">
                                Kata Sandi
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="forgot-link">
                                    Lupa kata sandi?
                                </a>
                            @endif
                        </div>

                        <div class="field-wrapper">
                            <i data-feather="lock" class="field-icon"></i>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control-custom @error('password') is-invalid @enderror"
                                placeholder="Masukkan kata sandi"
                                required
                                autocomplete="current-password"
                            >
                        </div>

                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- REMEMBER ME -->
                    <div class="remember-row">
                        <input
                            type="checkbox"
                            id="remember_me"
                            name="remember"
                        >

                        <label for="remember_me">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    <!-- SUBMIT -->
                    <button type="submit" class="btn-login">
                        <span>Masuk ke Dashboard</span>
                        <i data-feather="arrow-right" style="width:16px;height:16px;"></i>
                    </button>

                </form>

                <div class="login-security">
                    <i data-feather="shield" style="width:13px;height:13px;"></i>
                    Akses aman dan terbatas untuk pengguna terdaftar
                </div>

            </section>

        </div>

        <div class="mobile-footer">
            &copy; {{ date('Y') }} {{ $siteTitle }}.
            Seluruh hak cipta dilindungi.
        </div>

    </div>
</main>

<!-- Scripts -->
<script src="{{ asset('template/assets/vendors/core/core.js') }}"></script>
<script src="{{ asset('template/assets/vendors/feather-icons/feather.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>

</body>
</html>
