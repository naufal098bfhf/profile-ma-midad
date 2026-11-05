
@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
<div class="row">
    <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                    <h6 class="card-title mb-0">Tambah Galeri</h6>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item d-flex align-items-center"
                               href="{{ route('admin.galleries.index') }}">
                                <i data-feather="list" class="icon-sm me-2"></i>
                                Daftar Galeri
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row align-items-start">
                    <div class="col-md-7">
                        <p class="text-muted tx-13 mb-3 mb-md-0">
                            Buat galeri foto baru untuk Kegiatan MAS Miftahul Midad.
                            Upload gambar dan isi informasi yang diperlukan.
                        </p>
                    </div>
                    <div class="col-md-5 d-flex justify-content-md-end">
                        <a href="{{ route('admin.galleries.index') }}"
                           class="btn btn-secondary mb-3 mb-md-0">
                            <i data-feather="arrow-left" class="icon-sm me-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.galleries.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">

                            <div class="mb-3">
    <label for="title" class="form-label">
        Judul Album <span class="text-danger">*</span>
    </label>

    <input type="text"
           class="form-control @error('title') is-invalid @enderror"
           id="title"
           name="title"
           value="{{ old('title') }}"
           placeholder="Contoh: Peringatan Hari Santri Nasional 2026"
           required>

    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    Deskripsi
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description"
                                          name="description"
                                          rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="images" class="form-label">
                                    Upload Foto <span class="text-danger">*</span>
                                </label>

                                <input type="file"
                                       class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                                       id="images"
                                       name="images[]"
                                       accept="image/jpeg,image/png,image/gif,image/webp"
                                       multiple
                                       required>

                               <small class="form-text text-muted">
    Format: JPG, PNG, GIF, WebP.
    Maksimal 20 MB per foto dan 50 foto per album.
    <br>
    <strong>Tips:</strong> Pilih beberapa foto sekaligus.
    Foto pertama otomatis menjadi cover album.
    Seluruh foto akan masuk ke dalam satu album.
</small>

                                @error('images')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror

                                @error('images.*')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror

                                <div id="imagePreview" class="mt-3" style="display:none;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Preview Foto yang Dipilih</h6>
                                        <span id="imageCount" class="badge bg-primary"></span>
                                    </div>
                                    <div id="previewContainer" class="row"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="mb-3">
                                <label for="category_id" class="form-label">
                                    Kategori <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('category_id') is-invalid @enderror"
                                        id="category_id"
                                        name="category_id"
                                        required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <small class="form-text text-muted">
                                    <a href="{{ route('admin.gallery-categories.create') }}"
                                       class="btn btn-link p-0 text-primary"
                                       target="_blank">
                                        <i data-feather="plus" class="icon-sm me-1"></i>
                                        Tambah Kategori Baru
                                    </a>
                                </small>
                            </div>

                            <div class="mb-3">
                                <label for="sort_order" class="form-label">
                                    Urutan Tampil
                                </label>
                                <input type="number"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order"
                                       name="sort_order"
                                       value="{{ old('sort_order', 0) }}"
                                       min="0">
                                <small class="form-text text-muted">
                                    Angka kecil akan ditampilkan lebih dulu.
                                </small>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           id="is_published"
                                           name="is_published"
                                           value="1"
                                           {{ old('is_published') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">
                                        Publikasikan
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           id="is_featured"
                                           name="is_featured"
                                           value="1"
                                           {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Featured
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.galleries.index') }}"
                           class="btn btn-secondary me-2">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i data-feather="save" class="icon-sm me-2"></i>
                            Simpan Galeri
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script>
$(function () {
    'use strict';

    // Auto resize textarea.
    $('textarea').on('input', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // Preview multiple images.
    $('#images').on('change', function () {
        const files = Array.from(this.files);
        const previewContainer = $('#previewContainer');
        const imagePreview = $('#imagePreview');

        previewContainer.empty();

        if (files.length === 0) {
            imagePreview.hide();
            return;
        }

        imagePreview.show();
        $('#imageCount').text(files.length + ' foto dipilih');

        if (files.length > 50) {
            alert('Maksimal 50 foto dalam satu kali upload.');
            this.value = '';
            imagePreview.hide();
            return;
        }

        files.forEach(function (file, index) {
            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                const col = $('<div>', {
                    class: 'col-6 col-md-4 col-lg-3 mb-3'
                });

                const card = $('<div>', {
                    class: 'card h-100'
                });

                const img = $('<img>', {
                    src: event.target.result,
                    class: 'card-img-top',
                    alt: 'Preview foto ' + (index + 1)
                }).css({
                    height: '150px',
                    objectFit: 'cover'
                });

                const body = $('<div>', {
                    class: 'card-body p-2'
                });

                $('<small>', {
                    class: 'text-muted d-block',
                    text: 'Foto ' + (index + 1)
                }).appendTo(body);

                $('<small>', {
                    class: 'text-muted',
                    text: (file.size / 1024 / 1024).toFixed(2) + ' MB'
                }).appendTo(body);

                card.append(img, body);
                col.append(card);
                previewContainer.append(col);
            };

            reader.readAsDataURL(file);
        });
    });
});
</script>
@endpush
