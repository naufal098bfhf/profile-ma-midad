@extends('layouts.app')

@php
    $siteTitle = \App\Models\Setting::getValue('site_title', 'SMPIT Al-Itqon');
    // Extract year from registration dates in database
    $startYear = $ppdb->registration_start ? $ppdb->registration_start->format('Y') : date('Y');
    $endYear = $ppdb->registration_end ? $ppdb->registration_end->format('Y') : (date('Y') + 1);
    
    // If both dates are in the same year, use that year and next year
    if ($startYear == $endYear) {
        $yearText = $startYear . '/' . ($startYear + 1);
    } else {
        $yearText = $startYear . '/' . $endYear;
    }
    
    $metaDescription = "Penerimaan Peserta Didik Baru (PPDB) SMPIT Al-Itqon. Daftar sekarang untuk tahun ajaran {$yearText}. Informasi lengkap pendaftaran, persyaratan, dan jadwal seleksi.";
@endphp

@section('title', 'PPDB - ' . $siteTitle)
@section('description', $metaDescription)

@push('og_image')
@if($ppdb->og_image_url)
    <meta property="og:image" content="{{ $ppdb->og_image_url }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:alt" content="{{ $ppdb->title }}">
@endif
@endpush

@push('twitter_image')
@if($ppdb->og_image_url)
    <meta name="twitter:image" content="{{ $ppdb->og_image_url }}">
@endif
@endpush

@push('styles')
<style>
    .ppdb-hero {
        background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
        color: white;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }
    
    .ppdb-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .ppdb-hero-content {
        position: relative;
        z-index: 2;
    }
    
    .cta-buttons {
        margin-top: 2rem;
    }
    
    .cta-btn {
        margin: 0.5rem;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .cta-btn-primary {
        background: #ffffff;
        color: #0d9488;
        border: 2px solid #ffffff;
    }
    
    .cta-btn-primary:hover {
        background: transparent;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255,255,255,0.3);
    }
    
    .cta-btn-secondary {
        background: transparent;
        color: #ffffff;
        border: 2px solid #ffffff;
    }
    
    .cta-btn-secondary:hover {
        background: #ffffff;
        color: #0d9488;
        transform: translateY(-2px);
    }
    
    .cta-btn-whatsapp {
        background: #25D366;
        color: #ffffff;
        border: 2px solid #25D366;
    }
    
    .cta-btn-whatsapp:hover {
        background: #128C7E;
        color: #ffffff;
        border-color: #128C7E;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
    }
    
    .section-title {
        color: #0d9488;
        font-weight: 700;
        margin-bottom: 3rem;
        position: relative;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #0d9488, #14b8a6);
        border-radius: 2px;
    }
    
    .facility-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid #f0f9ff;
    }
    
    .facility-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    
    .facility-icon {
        font-size: 3rem;
        color: #0d9488;
        margin-bottom: 1rem;
    }
    
    .activity-card {
        background: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .activity-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    
    .activity-image {
        height: 200px;
        background: linear-gradient(135deg, #0d9488, #14b8a6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
    }
    
    .faq-item {
        background: #ffffff;
        border-radius: 10px;
        margin-bottom: 1rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .faq-question {
        background: #f8fafc;
        padding: 1.5rem;
        margin: 0;
        font-weight: 600;
        color: #0d9488;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        width: 100%;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .faq-question:hover {
        background: #e0f2fe;
    }
    
    .faq-answer {
        padding: 0 1.5rem 1.5rem;
        color: #64748b;
        line-height: 1.6;
        display: none;
    }
    
    .faq-answer.show {
        display: block;
    }
    
    .faq-icon {
        transition: transform 0.3s ease;
    }
    
    .faq-icon.rotated {
        transform: rotate(180deg);
    }
    
    .info-card {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        border-left: 5px solid #0d9488;
    }
    
    .info-card h4 {
        color: #0d9488;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .info-card p {
        color: #64748b;
        margin-bottom: 0;
    }
    
    .security-badge {
        background: #10b981;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        margin: 0.25rem;
    }
    
    .security-badge i {
        margin-right: 0.5rem;
    }

    /* Document Card Styles */
    .document-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        display: flex;
        flex-direction: column;
    }
    
    .document-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .document-icon {
        font-size: 3rem;
        margin-bottom: 20px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .document-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
    }
    
    .document-description {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 15px;
        line-height: 1.5;
    }
    
    .document-meta {
        margin-bottom: 15px;
    }
    
    .document-actions {
        margin-top: auto;
        padding-top: 15px;
    }
    
    .document-actions .btn {
        border-radius: 25px;
        font-weight: 500;
        padding: 8px 20px;
    }
    
    @media (max-width: 768px) {
        .ppdb-hero {
            padding: 60px 0;
        }
        
        .cta-buttons {
            text-align: center;
        }
        
        .cta-btn {
            display: block;
            width: 100%;
            margin: 0.5rem 0;
        }
        
        .facility-card {
            margin-bottom: 2rem;
        }
        
        .activity-card {
            margin-bottom: 2rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="ppdb-hero">
    <div class="container">
        <div class="ppdb-hero-content text-center">
            <h1 class="display-4 fw-bold mb-4">{{ $ppdb->title }}</h1>
            <p class="lead mb-4">{{ $ppdb->description }}</p>
            
            <div class="cta-buttons">
                <a href="#registration" class="cta-btn cta-btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                </a>
                <a href="#download" class="cta-btn cta-btn-secondary">
                    <i class="fas fa-download me-2"></i>Download Formulir
                </a>
                <a href="{{ route('contact') }}" class="cta-btn cta-btn-secondary">
                    <i class="fas fa-phone me-2"></i>Hubungi Kami
                </a>
                <button onclick="shareToWhatsApp()" class="cta-btn cta-btn-whatsapp">
                    <i class="fab fa-whatsapp me-2"></i>Share ke WhatsApp
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Registration Info Section -->
<section class="py-5" id="registration">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Informasi Pendaftaran</h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="info-card">
                    <h4><i class="fas fa-calendar-alt me-2"></i>Jadwal Pendaftaran</h4>
                    <p><strong>{{ $ppdb->registration_period }}</strong><br>
                    Pendaftaran dilakukan secara online 24 jam</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="info-card">
                    <h4><i class="fas fa-money-bill-wave me-2"></i>Biaya Pendaftaran</h4>
                    <p><strong>{{ $ppdb->formatted_fee }}</strong><br>
                    Dapat dibayar via transfer atau langsung ke sekolah</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="info-card">
                    <h4><i class="fas fa-graduation-cap me-2"></i>Kuota Siswa</h4>
                    <p><strong>{{ $ppdb->quota }} Siswa</strong><br>
                    Terbagi dalam {{ ceil($ppdb->quota / 30) }} kelas @ 30 siswa</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- School Facilities Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Fasilitas Sekolah</h2>
                <p class="lead">Fasilitas lengkap dan modern untuk mendukung proses pembelajaran yang optimal</p>
            </div>
        </div>
        
        <div class="row">
            @forelse($facilities as $facility)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="facility-card">
                    <div class="facility-icon">
                        <i class="{{ $facility['icon'] }}"></i>
                    </div>
                    <h4 class="h5 mb-3">{{ $facility['name'] }}</h4>
                    <p class="text-muted">{{ $facility['description'] }}</p>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-4">
                    <i class="fas fa-building fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Fasilitas akan ditampilkan di sini</h5>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- School Activities Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Kegiatan Sekolah</h2>
                <p class="lead">Berbagai kegiatan yang mengembangkan potensi dan karakter siswa</p>
            </div>
        </div>
        
        <div class="row">
            @forelse($activeActivities as $activity)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="activity-card">
                    @if($activity->image)
                    <div class="activity-image">
                        <img src="{{ $activity->image_url }}" alt="{{ $activity->title }}" class="img-fluid">
                    </div>
                    @else
                    <div class="activity-image" style="color: {{ $activity->color }};">
                        <i class="{{ $activity->icon_class }}"></i>
                    </div>
                    @endif
                    <div class="card-body p-3">
                        <h5 class="card-title">{{ $activity->title }}</h5>
                        <p class="card-text text-muted">{{ $activity->description }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-4">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Kegiatan akan ditampilkan di sini</h5>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Documents Download Section -->
@if($downloadDocuments && $downloadDocuments->count() > 0)
<section class="py-5" id="download">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Dokumen Pendaftaran</h2>
                <p class="lead">Download formulir dan dokumen yang diperlukan untuk pendaftaran</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    @foreach($downloadDocuments as $document)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="document-card h-100">
                            <div class="document-icon">
                                <i class="{{ $document->icon }}"></i>
                            </div>
                            <div class="document-content">
                                <h5 class="document-title">{{ $document->name }}</h5>
                                @if($document->description)
                                <p class="document-description">{{ $document->description }}</p>
                                @endif
                                <div class="document-meta">
                                    <small class="text-muted">
                                        <i class="fas fa-file"></i> {{ strtoupper($document->extension) }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-weight-hanging"></i> {{ $document->formatted_size }}
                                    </small>
                                </div>
                                @if($document->is_required)
                                <span class="badge bg-warning mb-2">Wajib</span>
                                @endif
                            </div>
                            <div class="document-actions">
                                <a href="{{ route('ppdb.download', ['ppdb' => $ppdb->id, 'document' => $document->id]) }}" 
                                   class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-download me-2"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- FAQ Section -->
<section class="py-5 bg-light" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
                <p class="lead">Temukan jawaban untuk pertanyaan yang sering ditanyakan seputar PPDB</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @forelse($activeFaqs as $index => $faq)
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq({{ $index }})">
                        {{ $faq->question }}
                        <i class="fas fa-chevron-down faq-icon" id="faq-icon-{{ $index }}"></i>
                    </button>
                    <div class="faq-answer" id="faq-answer-{{ $index }}">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">FAQ akan ditampilkan di sini</h5>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Security & Authenticity Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Keamanan & Keaslian Informasi</h2>
                <p class="lead">Kami memastikan keamanan dan keaslian informasi PPDB</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center">
                    <div class="security-badge">
                        <i class="fas fa-shield-alt"></i>
                        Website Resmi Sekolah
                    </div>
                    <div class="security-badge">
                        <i class="fas fa-lock"></i>
                        Data Terlindungi SSL
                    </div>
                    <div class="security-badge">
                        <i class="fas fa-check-circle"></i>
                        Informasi Terverifikasi
                    </div>
                    <div class="security-badge">
                        <i class="fas fa-calendar-check"></i>
                        Update Berkala
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <p class="text-muted">
                        <strong>Terakhir diperbarui:</strong> {{ $ppdb->updated_at->format('d F Y') }}<br>
                        <strong>Domain resmi:</strong> {{ request()->getHost() }}<br>
                        <strong>Kontak resmi:</strong> {{ $ppdb->contact_phone ?? '(021) 1234-5678' }} | {{ $ppdb->contact_email ?? 'info@smpitalitqon.sch.id' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
// WhatsApp Share Function
function shareToWhatsApp() {
    const title = "{{ $ppdb->title }}";
    const description = "{{ $ppdb->description }}";
    const url = window.location.href;
    
    // Create share message
    const message = `*${title}*\n\n${description}\n\n*INFORMASI PENDAFTARAN:*\n• Periode: {{ $ppdb->registration_period }}\n• Kuota: {{ $ppdb->quota }} siswa\n• Biaya: {{ $ppdb->formatted_fee }}\n\n*KONTAK:*\n• Telp: {{ $ppdb->contact_phone ?? 'Tersedia di website' }}\n• Email: {{ $ppdb->contact_email ?? 'Tersedia di website' }}\n\n*LINK PENDAFTARAN:*\n${url}\n\n*Yuk daftar sekarang!*`;
    
    // Encode message for URL
    const encodedMessage = encodeURIComponent(message);
    
    // Create WhatsApp URL
    const whatsappUrl = `https://wa.me/?text=${encodedMessage}`;
    
    // Open WhatsApp
    window.open(whatsappUrl, '_blank');
}

// Make toggleFaq function globally available
function toggleFaq(index) {
    console.log('toggleFaq called with index:', index);
    const answer = document.getElementById('faq-answer-' + index);
    const icon = document.getElementById('faq-icon-' + index);
    
    if (!answer || !icon) {
        console.error('FAQ elements not found for index:', index);
        return;
    }
    
    if (answer.classList.contains('show')) {
        answer.classList.remove('show');
        icon.classList.remove('rotated');
        console.log('FAQ closed for index:', index);
    } else {
        // Close all other FAQs
        document.querySelectorAll('.faq-answer').forEach(function(item) {
            item.classList.remove('show');
        });
        document.querySelectorAll('.faq-icon').forEach(function(item) {
            item.classList.remove('rotated');
        });
        
        // Open current FAQ
        answer.classList.add('show');
        icon.classList.add('rotated');
        console.log('FAQ opened for index:', index);
    }
}

// Smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endsection


