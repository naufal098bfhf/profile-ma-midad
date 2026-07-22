<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $siteTitle = \App\Models\Setting::getValue('site_title', config('app.name', 'Laravel'));
        $siteLogo = \App\Models\Setting::getValue('site_logo');
        $siteIcon = \App\Models\Setting::getValue('site_icon');
        $favicon = \App\Models\Setting::getValue('favicon');
        $metaKeywords = \App\Models\Setting::getValue('meta_keywords');
        $metaDescription = \App\Models\Setting::getValue('meta_description');
        $googleAnalytics = \App\Models\Setting::getValue('google_analytics');

        $indexableRoutes = [
            'home',
            'articles.index',
            'article.detail',
            'category.show',
            'author.show',
            'announcements.index',
            'announcements.show',
            'galleries.index',
            'galleries.show',
            'pena-karsa.index',
            'pena-karsa.show',
            'contact',
            'ppdb.index',
            'documents.index'
        ];

        $shouldIndex = request()->routeIs($indexableRoutes);
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $siteTitle)</title>

    @if(!empty($siteLogo))
        <link rel="icon" type="image/png" href="{{ $siteLogo }}">
        <link rel="shortcut icon" href="{{ $siteLogo }}">
        <link rel="apple-touch-icon" href="{{ $siteLogo }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    @endif
        <!-- Open Graph Meta Tags -->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ $siteTitle }}">
        <meta property="og:title" content="@yield('title', $siteTitle)">
        <meta property="og:description" content="@yield('description', $metaDescription ?: 'Berita dan Artikel Islami dari SMPIT Al-Itqon')">
        <meta property="og:url" content="{{ url()->current() }}">
        @stack('og_image')
        @if(View::hasSection('og_image'))
            @yield('og_image')
        @elseif(!empty($siteLogo))
            <meta property="og:image" content="{{ $siteLogo }}">
            <meta property="og:image:width" content="1200">
            <meta property="og:image:height" content="630">
            <meta property="og:image:type" content="image/png">
        @endif
        <meta property="og:locale" content="id_ID">

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('title', $siteTitle)">
        <meta name="twitter:description" content="@yield('description', $metaDescription ?: 'Berita dan Artikel Islami dari SMPIT Al-Itqon')">
        @stack('twitter_image')
        @if(View::hasSection('twitter_image'))
            @yield('twitter_image')
        @elseif(!empty($siteLogo))
            <meta name="twitter:image" content="{{ $siteLogo }}">
        @endif

        @if(!empty($siteLogo))
    <link rel="icon" type="image/png" href="{{ $siteLogo }}">
    <link rel="shortcut icon" href="{{ $siteLogo }}">
    <link rel="apple-touch-icon" href="{{ $siteLogo }}">
@endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CDN as fallback -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

        <!-- GLightbox CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- GLightbox JS -->
        <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>

        <!-- Additional CSS for specific pages -->
        @stack('styles')

        <!-- Google Analytics -->
        @if(!empty($googleAnalytics))
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $googleAnalytics }}"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', '{{ $googleAnalytics }}');
        </script>
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        <!-- Social Media Sidebar -->
        @include('components.social-sidebar')

        @include('layouts.footer')
    </body>
</html>
