
@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<div class="row">
    <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                    <h6 class="card-title mb-0">Edit Galeri</h6>
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
                            <a class="dropdown-item d-flex align-items-center"
                               href="{{ route('admin.galleries.show', $gallery) }}">
                                <i data-feather="eye" class="icon-sm me-2"></i>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row align-items-start">
                    <div class="col-md-7">
                        <p class="text-muted tx-13 mb-3 mb-md-0">
                            Edit galeri "{{ $gallery->title }}".
                            Perbarui informasi yang diperlukan.
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

                <form action="{{ route('admin.galleries.update', $gallery) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">

                            <div class="mb-3">
                                <label for="title" class="form-label">
                                    Judul Galeri <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('title') is-invalid @enderror"
                                       id="title"
                                       name="title"
                                       value="{{ old('title', $gallery->title) }}"
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
                                          rows="4">{{ old('description', $gallery->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto Saat Ini</label>

                                @if($gallery->image)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $gallery->image) }}"
                                             alt="{{ $gallery->title }}"
                                             class="img-thumbnail"
                                             style="max-width: 250px; max-height: 180px; object-fit: cover;">
                                        <div class="small text-muted mt-1">
                                            Foto yang tersimpan saat ini tidak akan dihapus ketika kamu menambahkan foto baru.
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted">Belum ada foto.</p>
                                @endif

                                @if($gallery->thumbnail)
                                    <div class="mb-3">
                                        <small class="text-muted d-block mb-1">
                                            Thumbnail saat ini:
                                        </small>
                                        <img src="{{ asset('storage/' . $gallery->thumbnail) }}"
                                             alt="Thumbnail {{ $gallery->title }}"
                                             class="img-thumbnail"
                                             style="max-width: 120px; max-height: 100px; object-fit: cover;">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="images" class="form-label">
                                    Tambahkan Foto Baru
                                </label>

                                <input type="file"
                                       class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                                       id="images"
                                       name="images[]"
                                       accept="image/jpeg,image/png,image/gif,image/webp"
                                       multiple>

                                <small class="form-text text-muted">
                                    Format: JPG, PNG, GIF, WebP. Maksimal 20 MB per foto.
                                    Maksimal 50 foto dalam satu kali upload.
                                    <br>
                                    <strong>Catatan:</strong> Foto lama tetap tersimpan.
                                    Foto baru akan ditambahkan ke album "{{ $gallery->title }}".
Seluruh foto tetap berada dalam satu album.
                                </small>

                                @error('images')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror

                                @error('images.*')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror

                                <div id="imagePreview" class="mt-3" style="display:none;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Preview Foto Baru</h6>
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
                                            {{ old('category_id', $gallery->category_id) == $category->id ? 'selected' : '' }}>
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
                                       value="{{ old('sort_order', $gallery->sort_order) }}"
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
                                           {{ old('is_published', $gallery->is_published) ? 'checked' : '' }}>
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
                                           {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}>
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
                            Update Galeri
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

    // Preview multiple new images.
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
                    alt: 'Preview foto baru ' + (index + 1)
                }).css({
                    height: '150px',
                    objectFit: 'cover'
                });

                const body = $('<div>', {
                    class: 'card-body p-2'
                });

                $('<small>', {
                    class: 'text-muted d-block',
                    text: 'Foto baru ' + (index + 1)
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
