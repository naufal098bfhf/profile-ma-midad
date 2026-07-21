@extends('layouts.admin')

@section('title', 'Tambah PPDB')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus me-2"></i>
                        Tambah PPDB Baru
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.ppdb.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.ppdb.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                                                   value="{{ old('title') }}" 
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
                                                   value="{{ old('slug') }}"
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
                                                      required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="content" class="form-label">Konten Lengkap</label>
                                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                                      id="content" 
                                                      name="content" 
                                                      rows="10">{{ old('content') }}</textarea>
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
                                                           value="{{ old('registration_start') }}" 
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
                                                           value="{{ old('registration_end') }}" 
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
                                                               value="{{ old('registration_fee') }}" 
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
                                                           value="{{ old('quota') }}" 
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
                                                      rows="4">{{ old('requirements') }}</textarea>
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
                                                              rows="3">{{ old('test_schedule') }}</textarea>
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
                                                              rows="3">{{ old('announcement_schedule') }}</textarea>
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
                                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
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
                                                   {{ old('is_featured') ? 'checked' : '' }}>
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
                                                   value="{{ old('contact_phone') }}">
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
                                                   value="{{ old('contact_email') }}">
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
                                        <div class="mb-3">
                                            <label for="hero_image" class="form-label">Upload Gambar Hero</label>
                                            <input type="file" 
                                                   class="form-control @error('hero_image') is-invalid @enderror" 
                                                   id="hero_image" 
                                                   name="hero_image" 
                                                   accept="image/*">
                                            @error('hero_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.ppdb.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan PPDB
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
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
</script>
@endpush

