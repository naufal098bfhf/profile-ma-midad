
@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Sejarah Madrasah</h2>
            <p class="text-muted mb-0">
                Kelola narasi dan dokumentasi sejarah MA Miftahul Midad.
            </p>
        </div>
    </div>

    {{-- PESAN BERHASIL --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- PESAN ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.institution-history.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- NARASI SEJARAH --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold">
                <i class="bi bi-book-half me-2"></i>
                Narasi Sejarah Madrasah
            </div>

            <div class="card-body">
                <label for="history" class="form-label fw-semibold">
                    Isi Sejarah
                </label>

                <textarea
                    name="history"
                    id="history"
                    rows="12"
                    maxlength="50000"
                    class="form-control @error('history') is-invalid @enderror"
                    placeholder="Tuliskan sejarah berdirinya MA Miftahul Midad dalam bentuk paragraf..."
                >{{ old('history', $history->history) }}</textarea>

                @error('history')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted d-block mt-2">
                    Tuliskan sejarah dalam bentuk paragraf. Pisahkan paragraf
                    dengan menekan Enter. Tidak perlu menggunakan format poin.
                </small>
            </div>
        </div>

        {{-- DOKUMENTASI FOTO --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold">
                <i class="bi bi-images me-2"></i>
                Dokumentasi Sejarah
            </div>

            <div class="card-body">

                <div class="alert alert-info">
                    Foto tidak wajib diisi. Admin dapat mengunggah satu foto,
                    dua foto, atau tidak mengunggah foto sama sekali.
                    Format JPG, JPEG, PNG, atau WEBP dengan ukuran maksimal 2 MB per foto.
                </div>

                <div class="row g-4">

                    {{-- FOTO 1 --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Foto Sejarah Pertama
                        </label>

                        <div class="mb-3">
                            <img
                                id="previewPhoto1"
                                src="{{ $history->photo_1
                                    ? asset('storage/' . $history->photo_1)
                                    : 'https://placehold.co/600x350?text=Foto+Sejarah+1' }}"
                                class="img-thumbnail w-100"
                                style="height:230px; object-fit:cover;"
                                alt="Foto sejarah pertama"
                            >
                        </div>

                        <input
                            type="file"
                            name="photo_1"
                            id="photo_1"
                            class="form-control @error('photo_1') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        @error('photo_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto pertama.
                        </small>
                    </div>

                    {{-- FOTO 2 --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Foto Sejarah Kedua
                        </label>

                        <div class="mb-3">
                            <img
                                id="previewPhoto2"
                                src="{{ $history->photo_2
                                    ? asset('storage/' . $history->photo_2)
                                    : 'https://placehold.co/600x350?text=Foto+Sejarah+2' }}"
                                class="img-thumbnail w-100"
                                style="height:230px; object-fit:cover;"
                                alt="Foto sejarah kedua"
                            >
                        </div>

                        <input
                            type="file"
                            name="photo_2"
                            id="photo_2"
                            class="form-control @error('photo_2') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        @error('photo_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto kedua.
                        </small>
                    </div>

                </div>
            </div>
        </div>

        {{-- TOMBOL SIMPAN --}}
        <div class="d-flex justify-content-end mb-4">
            <button type="submit" class="btn btn-success btn-lg">
                <i class="bi bi-save me-2"></i>
                Simpan Sejarah
            </button>
        </div>

    </form>
</div>
@endsection

@push('custom-js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    function previewImage(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        if (!input || !preview) return;

        input.addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        });
    }

    previewImage('photo_1', 'previewPhoto1');
    previewImage('photo_2', 'previewPhoto2');

});
</script>
@endpush
