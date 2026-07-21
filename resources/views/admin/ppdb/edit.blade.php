@extends('layouts.admin')

@section('title', 'Edit PPDB')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit me-2"></i>
                        Edit PPDB: {{ $ppdb->title }}
                    </h3>
                </div>

                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs px-3 pt-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-ppdb-tab" data-bs-toggle="tab" data-bs-target="#tab-ppdb" type="button" role="tab" aria-controls="tab-ppdb" aria-selected="true">
                            <i class="fas fa-info-circle me-2"></i>PPDB
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-faq-tab" data-bs-toggle="tab" data-bs-target="#tab-faq" type="button" role="tab" aria-controls="tab-faq" aria-selected="false">
                            <i class="fas fa-question-circle me-2"></i>FAQ
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-docs-tab" data-bs-toggle="tab" data-bs-target="#tab-docs" type="button" role="tab" aria-controls="tab-docs" aria-selected="false">
                            <i class="fas fa-file-download me-2"></i>Dokumen
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-activities-tab" data-bs-toggle="tab" data-bs-target="#tab-activities" type="button" role="tab" aria-controls="tab-activities" aria-selected="false">
                            <i class="fas fa-tasks me-2"></i>Kegiatan
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-ppdb" role="tabpanel" aria-labelledby="tab-ppdb-tab">
                <form action="{{ route('admin.ppdb.update', $ppdb) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Informasi Dasar</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Judul PPDB <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('title') is-invalid @enderror" 
                                                   id="title" 
                                                   name="title" 
                                                   value="{{ old('title', $ppdb->title) }}" 
                                                   required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="slug" class="form-label">Slug URL</label>
                                            <input type="text" 
                                                   class="form-control @error('slug') is-invalid @enderror" 
                                                   id="slug" 
                                                   name="slug" 
                                                   value="{{ old('slug', $ppdb->slug) }}"
                                                   placeholder="Akan dibuat otomatis jika kosong">
                                            @error('slug')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                      id="description" 
                                                      name="description" 
                                                      rows="3" 
                                                      required>{{ old('description', $ppdb->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="content" class="form-label">Konten Lengkap</label>
                                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                                      id="content" 
                                                      name="content" 
                                                      rows="10">{{ old('content', $ppdb->content) }}</textarea>
                                            @error('content')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                                <div class="mb-3">
                                                    <label for="registration_start" class="form-label">Tanggal Mulai Pendaftaran <span class="text-danger">*</span></label>
                                                    <input type="date" 
                                                           class="form-control @error('registration_start') is-invalid @enderror" 
                                                           id="registration_start" 
                                                           name="registration_start" 
                                                           value="{{ old('registration_start', $ppdb->registration_start->format('Y-m-d')) }}" 
                                                           required>
                                                    @error('registration_start')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="registration_end" class="form-label">Tanggal Selesai Pendaftaran <span class="text-danger">*</span></label>
                                                    <input type="date" 
                                                           class="form-control @error('registration_end') is-invalid @enderror" 
                                                           id="registration_end" 
                                                           name="registration_end" 
                                                           value="{{ old('registration_end', $ppdb->registration_end->format('Y-m-d')) }}" 
                                                           required>
                                                    @error('registration_end')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="registration_fee" class="form-label">Biaya Pendaftaran <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Rp</span>
                                                        <input type="number" 
                                                               class="form-control @error('registration_fee') is-invalid @enderror" 
                                                               id="registration_fee" 
                                                               name="registration_fee" 
                                                               value="{{ old('registration_fee', $ppdb->registration_fee) }}" 
                                                               min="0" 
                                                               step="1000" 
                                                               required>
                                                        @error('registration_fee')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="quota" class="form-label">Kuota Siswa <span class="text-danger">*</span></label>
                                                    <input type="number" 
                                                           class="form-control @error('quota') is-invalid @enderror" 
                                                           id="quota" 
                                                           name="quota" 
                                                           value="{{ old('quota', $ppdb->quota) }}" 
                                                           min="1" 
                                                           required>
                                                    @error('quota')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="requirements" class="form-label">Persyaratan Pendaftaran</label>
                                            <textarea class="form-control @error('requirements') is-invalid @enderror" 
                                                      id="requirements" 
                                                      name="requirements" 
                                                      rows="4">{{ old('requirements', $ppdb->requirements) }}</textarea>
                                            @error('requirements')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="test_schedule" class="form-label">Jadwal Tes</label>
                                                    <textarea class="form-control @error('test_schedule') is-invalid @enderror" 
                                                              id="test_schedule" 
                                                              name="test_schedule" 
                                                              rows="3">{{ old('test_schedule', $ppdb->test_schedule) }}</textarea>
                                                    @error('test_schedule')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="announcement_schedule" class="form-label">Jadwal Pengumuman</label>
                                                    <textarea class="form-control @error('announcement_schedule') is-invalid @enderror" 
                                                              id="announcement_schedule" 
                                                              name="announcement_schedule" 
                                                              rows="3">{{ old('announcement_schedule', $ppdb->announcement_schedule) }}</textarea>
                                                    @error('announcement_schedule')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror" 
                                                    id="status" 
                                                    name="status" 
                                                    required>
                                                <option value="draft" {{ old('status', $ppdb->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="active" {{ old('status', $ppdb->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                                <option value="inactive" {{ old('status', $ppdb->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="is_featured" 
                                                   name="is_featured" 
                                                   value="1" 
                                                   {{ old('is_featured', $ppdb->is_featured) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                Tampilkan di halaman utama
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5 class="card-title">Informasi Kontak</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="contact_phone" class="form-label">Nomor Telepon</label>
                                            <input type="text" 
                                                   class="form-control @error('contact_phone') is-invalid @enderror" 
                                                   id="contact_phone" 
                                                   name="contact_phone" 
                                                   value="{{ old('contact_phone', $ppdb->contact_phone) }}">
                                            @error('contact_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="contact_email" class="form-label">Email Kontak</label>
                                            <input type="email" 
                                                   class="form-control @error('contact_email') is-invalid @enderror" 
                                                   id="contact_email" 
                                                   name="contact_email" 
                                                   value="{{ old('contact_email', $ppdb->contact_email) }}">
                                            @error('contact_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Hero Image -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5 class="card-title">Gambar Hero</h5>
                                    </div>
                                    <div class="card-body">
                                        @if($ppdb->hero_image)
                                            <div class="mb-3">
                                                <label class="form-label">Gambar Saat Ini</label>
                                                <div class="text-center">
                                                    <img src="{{ asset('storage/' . $ppdb->hero_image) }}" 
                                                         alt="{{ $ppdb->title }}" 
                                                         class="img-fluid rounded" 
                                                         style="max-height: 200px;">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label for="hero_image" class="form-label">Upload Gambar Baru</label>
                                            <input type="file" 
                                                   class="form-control @error('hero_image') is-invalid @enderror" 
                                                   id="hero_image" 
                                                   name="hero_image" 
                                                   accept="image/*">
                                            @error('hero_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update PPDB
                            </button>
                        </div>
                    </div>
                </form>
                    </div>

                    <div class="tab-pane fade" id="tab-faq" role="tabpanel" aria-labelledby="tab-faq-tab">
                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i>FAQ PPDB</h5>
                                <a href="{{ route('admin.ppdb.faqs.create', $ppdb) }}" class="btn btn-success"><i class="fas fa-plus me-2"></i>Tambah FAQ</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th style="width:60px">Urut</th>
                                            <th>Pertanyaan</th>
                                            <th style="width:120px">Status</th>
                                            <th style="width:160px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ppdb->faqs()->orderBy('sort_order')->get() as $faq)
                                        <tr>
                                            <td>{{ $faq->sort_order }}</td>
                                            <td>
                                                <div class="fw-semibold">{{ Str::limit($faq->question, 100) }}</div>
                                                <div class="text-muted small">{{ Str::limit(strip_tags($faq->answer), 120) }}</div>
                                            </td>
                                            <td>
                                                @if($faq->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.faqs.edit', [$ppdb, $faq]) }}">
                                                            <i data-feather="edit" class="icon-sm me-2"></i> <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.faqs.toggle-status', [$ppdb, $faq]) }}">
                                                            <i data-feather="toggle-right" class="icon-sm me-2"></i> <span>Toggle Aktif</span>
                                                        </a>
                                                        <form action="{{ route('admin.ppdb.faqs.destroy', [$ppdb, $faq]) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Hapus FAQ ini?')">
                                                                <i data-feather="trash-2" class="icon-sm me-2"></i> <span>Hapus</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Belum ada FAQ.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-docs" role="tabpanel" aria-labelledby="tab-docs-tab">
                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0"><i class="fas fa-file-download me-2"></i>Dokumen PPDB</h5>
                                <a href="{{ route('admin.ppdb.documents.create', $ppdb) }}" class="btn btn-success"><i class="fas fa-plus me-2"></i>Tambah Dokumen</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th style="width:60px">Urut</th>
                                            <th>Nama</th>
                                            <th style="width:120px">Wajib</th>
                                            <th style="width:120px">Status</th>
                                            <th style="width:200px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ppdb->documents()->orderBy('sort_order')->get() as $doc)
                                        <tr>
                                            <td>{{ $doc->sort_order }}</td>
                                            <td>
                                                <div class="fw-semibold">{{ $doc->name }}</div>
                                                <div class="text-muted small">{{ Str::limit($doc->description, 120) }}</div>
                                            </td>
                                            <td>
                                                @if($doc->is_required)
                                                    <span class="badge bg-info">Wajib</span>
                                                @else
                                                    <span class="badge bg-light text-muted">Opsional</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($doc->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.edit', [$ppdb, $doc]) }}">
                                                            <i data-feather="edit" class="icon-sm me-2"></i> <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.toggle-required', [$ppdb, $doc]) }}">
                                                            <i data-feather="alert-circle" class="icon-sm me-2"></i> <span>Toggle Wajib</span>
                                                        </a>
                                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.toggle-status', [$ppdb, $doc]) }}">
                                                            <i data-feather="toggle-right" class="icon-sm me-2"></i> <span>Toggle Aktif</span>
                                                        </a>
                                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.download', [$ppdb, $doc]) }}">
                                                            <i data-feather="download" class="icon-sm me-2"></i> <span>Download</span>
                                                        </a>
                                                        <form action="{{ route('admin.ppdb.documents.destroy', [$ppdb, $doc]) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Hapus dokumen ini?')">
                                                                <i data-feather="trash-2" class="icon-sm me-2"></i> <span>Hapus</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">Belum ada dokumen.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-activities" role="tabpanel" aria-labelledby="tab-activities-tab">
                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Kegiatan PPDB</h5>
                                <a href="{{ route('admin.ppdb.activities.create', $ppdb) }}" class="btn btn-success"><i class="fas fa-plus me-2"></i>Tambah Kegiatan</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th style="width:60px">Urut</th>
                                            <th>Judul</th>
                                            <th style="width:120px">Status</th>
                                            <th style="width:200px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ppdb->activities()->orderBy('sort_order')->get() as $act)
                                        <tr>
                                            <td>{{ $act->sort_order }}</td>
                                            <td>
                                                <div class="fw-semibold">{{ $act->title }}</div>
                                                <div class="text-muted small">{{ Str::limit(strip_tags($act->description), 120) }}</div>
                                            </td>
                                            <td>
                                                @if($act->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.activities.edit', [$ppdb, $act]) }}">
                                                            <i data-feather="edit" class="icon-sm me-2"></i> <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.activities.toggle-status', [$ppdb, $act]) }}">
                                                            <i data-feather="toggle-right" class="icon-sm me-2"></i> <span>Toggle Aktif</span>
                                                        </a>
                                                        <form action="{{ route('admin.ppdb.activities.destroy', [$ppdb, $act]) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Hapus kegiatan ini?')">
                                                                <i data-feather="trash-2" class="icon-sm me-2"></i> <span>Hapus</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Belum ada kegiatan.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script>
// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
});

// Activate tab based on URL hash (e.g., #tab-faq, #tab-docs, #tab-activities)
document.addEventListener('DOMContentLoaded', function () {
    try {
        const hash = window.location.hash;
        if (hash) {
            const triggerBtn = document.querySelector(`button[data-bs-target='${hash}']`);
            if (triggerBtn && window.bootstrap && bootstrap.Tab) {
                const tab = new bootstrap.Tab(triggerBtn);
                tab.show();
            } else if (triggerBtn) {
                // Fallback: click the button if bootstrap.Tab isn't exposed
                triggerBtn.click();
            }
        }

        // Update URL hash when switching tabs
        document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(function (btn) {
            btn.addEventListener('shown.bs.tab', function (event) {
                const target = event.target.getAttribute('data-bs-target');
                if (target) {
                    history.replaceState(null, '', target);
                }
            });
        });
    } catch (e) {
        // no-op
    }
});
</script>
@endpush

