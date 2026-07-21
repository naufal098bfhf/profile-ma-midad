@extends('layouts.admin')

@section('title', 'Data Guru')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">Data Guru</h3>
            <small class="text-muted">
                Kelola seluruh data guru MA Miftahul Midad
            </small>
        </div>

        <a href="{{ route('admin.teachers.create') }}"
            class="btn btn-primary">

            <i class="fas fa-plus-circle me-1"></i>

            Tambah Guru

        </a>

    </div>

    {{-- Alert Success --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    {{-- Alert Error --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <div class="card shadow-sm border-0">

        <div class="card-body">

            {{-- Search --}}
            <form
                action="{{ route('admin.teachers.index') }}"
                method="GET"
                class="row g-3 mb-4">

                <div class="col-md-10">

                    <input
                        type="text"
                        class="form-control"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Cari nama, jabatan atau mata pelajaran">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        <i class="fas fa-search"></i>

                        Cari

                    </button>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="60">No</th>

                            <th width="90">Foto</th>

                            <th>Nama</th>

                            <th>Jabatan</th>

                            <th>Mata Pelajaran</th>

                            <th>Status</th>

                            <th width="140">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($teachers as $teacher)

                        <tr>

                            <td>

                                {{ $loop->iteration + ($teachers->firstItem() - 1) }}

                            </td>

                            <td>

                                <img
                                    src="{{ $teacher->photo_url }}"
                                    class="rounded"
                                    width="60"
                                    height="60"
                                    style="object-fit:cover;">

                            </td>

                            <td>

                                <strong>

                                    {{ $teacher->name }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    {{ $teacher->education }}

                                </small>

                            </td>

                            <td>

                                {{ $teacher->position }}

                            </td>

                            <td>

                                {{ $teacher->subject }}

                            </td>

                            <td>

                                @if($teacher->is_active)

                                    <span class="badge bg-success">

                                        Aktif

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Tidak Aktif

                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route('admin.teachers.edit',$teacher) }}"
                                        class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('admin.teachers.destroy',$teacher) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus guru ini?')">

                                        @csrf

                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                Tidak ada data guru.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $teachers->withQueryString()->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
