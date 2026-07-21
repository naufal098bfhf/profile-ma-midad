@extends('layouts.admin')

@section('title', 'Detail PPDB')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-eye me-2"></i>
                        Detail PPDB: {{ $ppdb->title }}
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.ppdb.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="{{ route('admin.ppdb.edit', $ppdb) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('ppdb.index') }}" class="btn btn-info" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>Lihat di Website
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Informasi Dasar</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Judul PPDB</h6>
                                            <p class="text-muted">{{ $ppdb->title }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Slug URL</h6>
                                            <p class="text-muted">{{ $ppdb->slug }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <h6>Deskripsi</h6>
                                        <p class="text-muted">{{ $ppdb->description }}</p>
                                    </div>

                                    @if($ppdb->content)
                                    <div class="mb-3">
                                        <h6>Konten Lengkap</h6>
                                        <div class="text-muted">
                                            {!! nl2br(e($ppdb->content)) !!}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Registration Details -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Detail Pendaftaran</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Periode Pendaftaran</h6>
                                            <p class="text-muted">{{ $ppdb->registration_period }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Biaya Pendaftaran</h6>
                                            <p class="text-muted"><strong>{{ $ppdb->formatted_fee }}</strong></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Kuota Siswa</h6>
                                            <p class="text-muted">{{ $ppdb->quota }} siswa</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Status Pendaftaran</h6>
                                            <p class="text-muted">
                                                @if($ppdb->isRegistrationOpen())
                                                    <span class="badge bg-success">Sedang Dibuka</span>
                                                @else
                                                    <span class="badge bg-danger">Ditutup</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    @if($ppdb->requirements)
                                    <div class="mb-3">
                                        <h6>Persyaratan Pendaftaran</h6>
                                        <div class="text-muted">
                                            {!! nl2br(e($ppdb->requirements)) !!}
                                        </div>
                                    </div>
                                    @endif

                                    @if($ppdb->test_schedule)
                                    <div class="mb-3">
                                        <h6>Jadwal Tes</h6>
                                        <div class="text-muted">
                                            {!! nl2br(e($ppdb->test_schedule)) !!}
                                        </div>
                                    </div>
                                    @endif

                                    @if($ppdb->announcement_schedule)
                                    <div class="mb-3">
                                        <h6>Jadwal Pengumuman</h6>
                                        <div class="text-muted">
                                            {!! nl2br(e($ppdb->announcement_schedule)) !!}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Contact Information -->
                            @if($ppdb->contact_phone || $ppdb->contact_email)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Informasi Kontak</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @if($ppdb->contact_phone)
                                        <div class="col-md-6">
                                            <h6>Nomor Telepon</h6>
                                            <p class="text-muted">{{ $ppdb->contact_phone }}</p>
                                        </div>
                                        @endif
                                        @if($ppdb->contact_email)
                                        <div class="col-md-6">
                                            <h6>Email Kontak</h6>
                                            <p class="text-muted">{{ $ppdb->contact_email }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <!-- Status & Settings -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Status & Pengaturan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h6>Status</h6>
                                        <span class="badge bg-{{ $ppdb->status_color }} fs-6">
                                            {{ $ppdb->status_label }}
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <h6>Featured</h6>
                                        @if($ppdb->is_featured)
                                            <span class="badge bg-warning">
                                                <i class="fas fa-star me-1"></i>Tampil di Halaman Utama
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">Tidak</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <h6>Dibuat</h6>
                                        <p class="text-muted">{{ $ppdb->created_at->format('d M Y H:i') }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6>Terakhir Diupdate</h6>
                                        <p class="text-muted">{{ $ppdb->updated_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Hero Image -->
                            @if($ppdb->hero_image)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Gambar Hero</h5>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ asset('storage/' . $ppdb->hero_image) }}" 
                                         alt="{{ $ppdb->title }}" 
                                         class="img-fluid rounded">
                                </div>
                            </div>
                            @endif

                            <!-- Quick Actions -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Aksi Cepat</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.ppdb.edit', $ppdb) }}" class="btn btn-warning">
                                            <i class="fas fa-edit me-2"></i>Edit PPDB
                                        </a>
                                        
                                        <form action="{{ route('admin.ppdb.toggle-featured', $ppdb) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="btn btn-{{ $ppdb->is_featured ? 'outline-warning' : 'outline-success' }} w-100"
                                                    onclick="return confirm('Yakin ingin mengubah status featured?')">
                                                <i class="fas fa-star me-2"></i>
                                                {{ $ppdb->is_featured ? 'Hapus dari Featured' : 'Jadikan Featured' }}
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.ppdb.toggle-status', $ppdb) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="btn btn-{{ $ppdb->status === 'active' ? 'outline-danger' : 'outline-success' }} w-100"
                                                    onclick="return confirm('Yakin ingin mengubah status?')">
                                                <i class="fas fa-{{ $ppdb->status === 'active' ? 'times' : 'check' }} me-2"></i>
                                                {{ $ppdb->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                        
                                        <a href="{{ route('ppdb.index') }}" class="btn btn-info" target="_blank">
                                            <i class="fas fa-external-link-alt me-2"></i>Lihat di Website
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

