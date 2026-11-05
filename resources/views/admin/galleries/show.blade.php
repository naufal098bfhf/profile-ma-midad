
@extends('layouts.admin')

@section('title', 'Detail Galeri')

@section('content')

<div class="row">
    <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="card overflow-hidden">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                    <h6 class="card-title mb-0">Detail Album Galeri</h6>

                    <div class="dropdown">
                        <button class="btn p-0"
                                type="button"
                                id="dropdownMenuButton3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">

                            <i class="icon-lg text-muted pb-3px"
                               data-feather="more-horizontal"></i>
                        </button>

                        <div class="dropdown-menu"
                             aria-labelledby="dropdownMenuButton3">

                            <a class="dropdown-item d-flex align-items-center"
                               href="{{ route('admin.galleries.index') }}">
                                <i data-feather="list" class="icon-sm me-2"></i>
                                <span>Daftar Galeri</span>
                            </a>

                            <a class="dropdown-item d-flex align-items-center"
                               href="{{ route('admin.galleries.edit', $gallery) }}">
                                <i data-feather="edit" class="icon-sm me-2"></i>
                                <span>Edit Album</span>
                            </a>

                            @if($gallery->is_published)
                                <a class="dropdown-item d-flex align-items-center"
                                   href="{{ route('galleries.show', $gallery->slug) }}"
                                   target="_blank">
                                    <i data-feather="external-link" class="icon-sm me-2"></i>
                                    <span>Preview Publik</span>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="row align-items-start">
                    <div class="col-md-7">
                        <p class="text-muted tx-13 mb-3 mb-md-0">
                            Detail lengkap album "{{ $gallery->title }}".
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


{{-- INFORMASI ALBUM DAN FOTO --}}
<div class="row">

    <div class="col-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <div class="row">

                    {{-- BAGIAN KIRI --}}
                    <div class="col-md-8">

                        {{-- INFORMASI ALBUM --}}
                        <div class="mb-4">

                            <h4 class="mb-3">
                                {{ $gallery->title }}
                            </h4>

                            <div class="d-flex align-items-center flex-wrap mb-3">

                                <span class="badge bg-{{ $gallery->category_color }} me-2 mb-1">
                                    {{ $gallery->category_label }}
                                </span>

                                @if($gallery->is_published)
                                    <span class="badge bg-success me-2 mb-1">
                                        Terbit
                                    </span>
                                @else
                                    <span class="badge bg-warning me-2 mb-1">
                                        Draft
                                    </span>
                                @endif

                                @if($gallery->is_featured)
                                    <span class="badge bg-info mb-1">
                                        Featured
                                    </span>
                                @endif

                            </div>

                            @if($gallery->description)
                                <p class="text-muted mb-3">
                                    {{ $gallery->description }}
                                </p>
                            @endif

                            <div class="d-flex align-items-center text-muted mb-3">
                                <i data-feather="images" class="icon-sm me-2"></i>

                                <strong>
                                    {{ $gallery->photos->count() }} Foto dalam Album
                                </strong>
                            </div>

                        </div>


                        {{-- COVER ALBUM --}}
                        @if($gallery->image)

                            <div class="mb-4">

                                <h6 class="mb-3">
                                    Cover Album
                                </h6>

                                <div class="text-center">

                                    <img
                                        src="{{ asset('storage/' . $gallery->image) }}"
                                        alt="{{ $gallery->title }}"
                                        class="img-fluid rounded shadow"
                                        style="max-height: 350px; width: 100%; object-fit: cover;"
                                    >

                                </div>

                            </div>

                        @endif


                        {{-- SELURUH FOTO ALBUM --}}
                        <div class="mt-4">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <h5 class="mb-0">
                                    Foto dalam Album
                                </h5>

                                <span class="badge bg-primary">
                                    {{ $gallery->photos->count() }} Foto
                                </span>

                            </div>


                            @if($gallery->photos->count() > 0)

                                <div class="row">

                                    @foreach($gallery->photos as $photo)

                                        <div class="col-6 col-md-4 mb-4">

                                            <div class="card h-100 border">

                                                <a href="{{ asset('storage/' . $photo->image) }}"
                                                   target="_blank">

                                                    <img
                                                        src="{{ asset('storage/' . ($photo->thumbnail ?? $photo->image)) }}"
                                                        alt="Foto {{ $loop->iteration }} - {{ $gallery->title }}"
                                                        class="card-img-top"
                                                        style="height: 180px; object-fit: cover;"
                                                    >

                                                </a>

                                                <div class="card-body p-2">

                                                    <div class="d-flex justify-content-between align-items-center">

                                                        <small class="text-muted">
                                                            Foto {{ $loop->iteration }}
                                                        </small>

                                                        <a href="{{ asset('storage/' . $photo->image) }}"
                                                           target="_blank"
                                                           class="text-primary"
                                                           title="Lihat foto asli">

                                                            <i data-feather="maximize-2"
                                                               class="icon-sm"></i>

                                                        </a>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            @else

                                <div class="alert alert-warning">
                                    <i data-feather="alert-circle" class="icon-sm me-2"></i>
                                    Belum ada foto yang tersimpan dalam album ini.
                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- BAGIAN KANAN --}}
                    <div class="col-md-4">

                        {{-- INFORMASI --}}
                        <div class="card">

                            <div class="card-body">

                                <h6 class="card-title mb-3">
                                    Informasi Album
                                </h6>

                                <div class="mb-3">
                                    <small class="text-muted d-block">ID Album</small>
                                    <span class="fw-bold">#{{ $gallery->id }}</span>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted d-block">Judul Album</small>
                                    <span>{{ $gallery->title }}</span>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted d-block">Kategori</small>
                                    <span class="badge bg-{{ $gallery->category_color }}">
                                        {{ $gallery->category_label }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted d-block">Jumlah Foto</small>
                                    <span class="fw-bold">
                                        {{ $gallery->photos->count() }} Foto
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted d-block">Status</small>

                                    @if($gallery->is_published)
                                        <span class="badge bg-success">Terbit</span>
                                    @else
                                        <span class="badge bg-warning">Draft</span>
                                    @endif
                                </div>

                                @if($gallery->is_featured)
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Featured</small>
                                        <span class="badge bg-info">Ya</span>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <small class="text-muted d-block">Urutan Tampil</small>
                                    <span>{{ $gallery->sort_order }}</span>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted d-block">Dibuat</small>
                                    <span>
                                        {{ $gallery->created_at->format('d M Y H:i') }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted d-block">Diperbarui</small>
                                    <span>
                                        {{ $gallery->updated_at->format('d M Y H:i') }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted d-block">Dilihat</small>
                                    <span>
                                        {{ number_format($gallery->views) }} kali
                                    </span>
                                </div>

                            </div>
                        </div>


                        {{-- AKSI --}}
                        <div class="card mt-3">

                            <div class="card-body">

                                <h6 class="card-title mb-3">
                                    Aksi Album
                                </h6>

                                <div class="d-grid gap-2">

                                    <a href="{{ route('admin.galleries.edit', $gallery) }}"
                                       class="btn btn-warning">

                                        <i data-feather="edit" class="icon-sm me-2"></i>
                                        Edit Album
                                    </a>

                                    @if($gallery->is_published)

                                        <a href="{{ route('galleries.show', $gallery->slug) }}"
                                           target="_blank"
                                           class="btn btn-info">

                                            <i data-feather="external-link" class="icon-sm me-2"></i>
                                            Preview Publik
                                        </a>

                                    @endif

                                    <form
                                        action="{{ route('admin.galleries.destroy', $gallery) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger w-100"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus album beserta seluruh fotonya?')">

                                            <i data-feather="trash-2" class="icon-sm me-2"></i>
                                            Hapus Album
                                        </button>

                                    </form>

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
