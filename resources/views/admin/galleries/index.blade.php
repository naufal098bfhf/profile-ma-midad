
@extends('layouts.admin')

@section('title', 'Kelola Album Galeri')

@section('content')

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card overflow-hidden">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="card-title mb-1">Kelola Album Galeri</h5>
                        <p class="text-muted tx-13 mb-0">
                            Setiap baris merupakan satu album yang dapat berisi banyak foto.
                        </p>
                    </div>

                    <a href="{{ route('admin.galleries.create') }}"
                       class="btn btn-primary">
                        <i data-feather="plus" class="icon-sm me-2"></i>
                        Tambah Album
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="dataTableExample" class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Cover Album</th>
                                <th>Informasi Album</th>
                                <th>Jumlah Foto</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Urutan</th>
                                <th>Dilihat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($galleries as $gallery)

                                <tr>
                                    {{-- NOMOR --}}
                                    <td>
                                        {{ $galleries->firstItem()
                                            ? $galleries->firstItem() + $loop->index
                                            : $loop->iteration }}
                                    </td>

                                    {{-- COVER ALBUM --}}
                                    <td>
                                        @if($gallery->thumbnail || $gallery->image)

                                            <img
                                                src="{{ asset('storage/' . ($gallery->thumbnail ?? $gallery->image)) }}"
                                                alt="{{ $gallery->title }}"
                                                class="rounded"
                                                style="width:75px; height:60px; object-fit:cover;"
                                            >

                                        @else

                                            <div class="d-flex align-items-center justify-content-center rounded"
                                                 style="width:75px; height:60px; background:#eef0f5;">
                                                <i data-feather="image" class="text-muted"></i>
                                            </div>

                                        @endif
                                    </td>

                                    {{-- INFORMASI ALBUM --}}
                                    <td style="min-width:200px;">
                                        <div>
                                            <h6 class="mb-1">
                                                {{ $gallery->title }}
                                            </h6>

                                            <small class="text-muted">
                                                {{ Str::limit($gallery->description, 70) }}
                                            </small>

                                            <br>

                                            <small class="text-muted">
                                                Dibuat:
                                                {{ $gallery->created_at->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </td>

                                    {{-- JUMLAH FOTO --}}
                                    <td>
                                        <span class="badge bg-primary">
                                            <i data-feather="images"
                                               style="width:12px;height:12px;"></i>
                                            {{ $gallery->photos_count }} Foto
                                        </span>
                                    </td>

                                    {{-- KATEGORI --}}
                                    <td>
                                        <span class="badge bg-{{ $gallery->category_color }}">
                                            {{ $gallery->category_label }}
                                        </span>
                                    </td>

                                    {{-- STATUS --}}
                                    <td>
                                        @if($gallery->is_published)
                                            <span class="badge bg-success">Terbit</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        @endif
                                    </td>

                                    {{-- URUTAN --}}
                                    <td>{{ $gallery->sort_order }}</td>

                                    {{-- JUMLAH DILIHAT --}}
                                    <td>
                                        {{ number_format($gallery->views ?? 0) }}
                                    </td>

                                    {{-- AKSI --}}
                                    <td>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-sm btn-light"
                                                type="button"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false">

                                                <i data-feather="more-horizontal"></i>

                                            </button>

                                            <div class="dropdown-menu dropdown-menu-end">

                                                <a class="dropdown-item"
                                                   href="{{ route('admin.galleries.show', $gallery) }}">
                                                    <i data-feather="eye"
                                                       class="icon-sm me-2"></i>
                                                    Detail Album
                                                </a>

                                                <a class="dropdown-item"
                                                   href="{{ route('admin.galleries.edit', $gallery) }}">
                                                    <i data-feather="edit"
                                                       class="icon-sm me-2"></i>
                                                    Edit Album
                                                </a>

                                                @if($gallery->is_published)
                                                    <a class="dropdown-item"
                                                       href="{{ route('galleries.show', $gallery->slug) }}"
                                                       target="_blank">
                                                        <i data-feather="external-link"
                                                           class="icon-sm me-2"></i>
                                                        Preview Publik
                                                    </a>
                                                @endif

                                                <div class="dropdown-divider"></div>

                                                <form
                                                    action="{{ route('admin.galleries.destroy', $gallery) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus album beserta seluruh fotonya?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="dropdown-item text-danger">
                                                        <i data-feather="trash-2"
                                                           class="icon-sm me-2"></i>
                                                        Hapus Album
                                                    </button>

                                                </form>

                                            </div>
                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <i data-feather="image"
                                           style="width:40px;height:40px;"
                                           class="text-muted mb-2"></i>

                                        <h6 class="text-muted">
                                            Belum ada album galeri.
                                        </h6>

                                        <a href="{{ route('admin.galleries.create') }}"
                                           class="btn btn-primary btn-sm mt-2">
                                            <i data-feather="plus"
                                               class="icon-sm me-1"></i>
                                            Tambah Album Pertama
                                        </a>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

                {{-- PAGINATION LARAVEL --}}
                @if(method_exists($galleries, 'links'))
                    <div class="mt-3">
                        {{ $galleries->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection

@push('plugin-css')
<link rel="stylesheet"
      href="{{ asset('template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
@endpush

@push('plugin-js')
<script src="{{ asset('template/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-js')
<script>
    $(function () {
        'use strict';

        $('#dataTableExample').DataTable({
            paging: false,
            searching: true,
            info: false,
            ordering: true,
            language: {
                search: '',
                searchPlaceholder: 'Cari album...',
                zeroRecords: 'Album tidak ditemukan',
                emptyTable: 'Belum ada album galeri',
                infoEmpty: ''
            },
            columnDefs: [
                {
                    orderable: false,
                    targets: [1, 8]
                }
            ]
        });

    });
</script>
@endpush
