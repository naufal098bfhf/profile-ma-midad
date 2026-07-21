@php
    $ppdb = \App\Models\Ppdb::active()->featured()->first();
    if (!$ppdb) {
        $ppdb = \App\Models\Ppdb::active()->latest()->first();
    }
    if (!$ppdb) {
        $ppdb = \App\Models\Ppdb::latest()->first();
    }
@endphp

@if($ppdb)
<!-- PPDB Widget -->
<div class="ppdb-widget">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="widget-header">
                    <h3 class="widget-title">
                        <i class="fas fa-graduation-cap"></i>
                        Penerimaan Peserta Didik Baru (PPDB)
                    </h3>
                    <a href="{{ route('ppdb.index') }}" class="view-all-btn">
                        Info Lengkap <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="ppdb-info-card">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="ppdb-title">{{ $ppdb->title }}</h4>
                            <p class="ppdb-description">
                                {{ Str::limit($ppdb->description, 150) }}
                            </p>
                            <div class="ppdb-meta">
                                <span class="ppdb-meta-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <strong>{{ $ppdb->registration_period }}</strong>
                                </span>
                                <span class="ppdb-meta-item">
                                    <i class="fas fa-users"></i>
                                    <strong>{{ $ppdb->quota }} Siswa</strong>
                                </span>
                                <span class="ppdb-meta-item">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <strong>{{ $ppdb->formatted_fee }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="ppdb-visual">
                                <i class="fas fa-school fa-4x text-primary mb-3"></i>
                                <div class="ppdb-badge">
                                    @if($ppdb->isRegistrationOpen())
                                        <span class="badge bg-success">Pendaftaran Dibuka</span>
                                    @else
                                        <span class="badge bg-danger">Pendaftaran Ditutup</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="ppdb-cta-card">
                    <h5 class="ppdb-cta-title">Daftar Sekarang!</h5>
                    <p class="ppdb-cta-text">Jangan lewatkan kesempatan untuk bergabung dengan SMPIT Al-Itqon</p>
                    
                    <div class="ppdb-cta-buttons">
                        <a href="{{ route('ppdb.index') }}" class="btn btn-primary btn-sm mb-2 w-100">
                            <i class="fas fa-user-plus me-2"></i>Daftar Online
                        </a>
                        <a href="{{ route('ppdb.index') }}#download" class="btn btn-outline-primary btn-sm mb-2 w-100">
                            <i class="fas fa-download me-2"></i>Download Formulir
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="fas fa-phone me-2"></i>Hubungi Kami
                        </a>
                    </div>
                    
                    <div class="ppdb-security-info mt-3">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt text-success me-1"></i>
                            Website resmi & terpercaya
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick FAQ Preview -->
        @if($ppdb->faqs && count($ppdb->faqs) > 0)
        <div class="row">
            <div class="col-12">
                <div class="ppdb-faq-preview">
                    <h5 class="ppdb-faq-title">
                        <i class="fas fa-question-circle me-2"></i>
                        Pertanyaan yang Sering Diajukan
                    </h5>
                    <div class="row">
                        @foreach(array_slice($ppdb->faqs, 0, 2) as $faq)
                        <div class="col-md-6">
                            <div class="ppdb-faq-item">
                                <strong>{{ Str::limit($faq['question'], 30) }}</strong>
                                <p class="text-muted mb-0">{{ Str::limit($faq['answer'], 50) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('ppdb.index') }}#faq" class="btn btn-outline-primary btn-sm">
                            Lihat FAQ Lengkap <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endif

<style>
.ppdb-widget {
    background: #f8fafc;
    padding: 3rem 0;
    margin: 2rem 0;
}

.ppdb-info-card {
    background: #ffffff;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    border-left: 5px solid #0d9488;
    height: 100%;
}

.ppdb-title {
    color: #0d9488;
    font-weight: 700;
    margin-bottom: 1rem;
}

.ppdb-description {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.ppdb-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.ppdb-meta-item {
    display: flex;
    align-items: center;
    color: #0d9488;
    font-size: 0.9rem;
}

.ppdb-meta-item i {
    margin-right: 0.5rem;
    width: 16px;
}

.ppdb-visual {
    text-align: center;
}

.ppdb-badge {
    margin-top: 1rem;
}

.ppdb-cta-card {
    background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
    color: white;
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.ppdb-cta-title {
    font-weight: 700;
    margin-bottom: 1rem;
}

.ppdb-cta-text {
    margin-bottom: 1.5rem;
    opacity: 0.9;
}

.ppdb-cta-buttons .btn {
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.ppdb-cta-buttons .btn-primary {
    background: #ffffff;
    color: #0d9488;
    border: 2px solid #ffffff;
}

.ppdb-cta-buttons .btn-primary:hover {
    background: transparent;
    color: #ffffff;
    transform: translateY(-2px);
}

.ppdb-cta-buttons .btn-outline-primary {
    color: #ffffff;
    border-color: #ffffff;
}

.ppdb-cta-buttons .btn-outline-primary:hover {
    background: #ffffff;
    color: #0d9488;
    transform: translateY(-2px);
}

.ppdb-cta-buttons .btn-outline-secondary {
    color: #ffffff;
    border-color: rgba(255,255,255,0.5);
}

.ppdb-cta-buttons .btn-outline-secondary:hover {
    background: rgba(255,255,255,0.1);
    color: #ffffff;
    border-color: #ffffff;
}

.ppdb-faq-preview {
    background: #ffffff;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-top: 2rem;
}

.ppdb-faq-title {
    color: #0d9488;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.ppdb-faq-item {
    margin-bottom: 1rem;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 10px;
    border-left: 3px solid #0d9488;
}

.ppdb-security-info {
    text-align: center;
    padding-top: 1rem;
    border-top: 1px solid rgba(255,255,255,0.2);
}

@media (max-width: 768px) {
    .ppdb-widget {
        padding: 2rem 0;
    }
    
    .ppdb-info-card,
    .ppdb-cta-card,
    .ppdb-faq-preview {
        padding: 1.5rem;
    }
    
    .ppdb-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .ppdb-visual {
        margin-top: 1rem;
    }
}
</style>
