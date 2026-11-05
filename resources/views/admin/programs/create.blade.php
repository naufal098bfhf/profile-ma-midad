
@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h2 class="mb-4">Tambah Program Madrasah</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.programs.store') }}"
                  method="POST">
                @csrf

                <div class="mb-3">
                    <label for="category" class="form-label">
                        Kategori Program
                    </label>

                    <select name="category" id="category"
                            class="form-select" required>
                        <option value="">Pilih kategori</option>

                        @foreach ($categories as $key => $label)
                            <option value="{{ $key }}"
                                @selected(old('category') === $key)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">
                        Nama Program
                    </label>

                    <input type="text" name="title" id="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           required maxlength="255"
                           placeholder="Contoh: Penguatan Literasi">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">
                        Deskripsi Program
                    </label>

                    <textarea name="description" id="description"
                              class="form-control" rows="5"
                              placeholder="Jelaskan tujuan dan kegiatan program...">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label">
                        Urutan Tampilan
                    </label>

                    <input type="number" name="sort_order" id="sort_order"
                           class="form-control" min="0"
                           value="{{ old('sort_order', 0) }}">
                </div>

                <div class="form-check form-switch mb-4">
                    <input type="hidden" name="is_active" value="0">

                    <input type="checkbox" name="is_active"
                           id="is_active" value="1"
                           class="form-check-input"
                           @checked(old('is_active', '1') == '1')>

                    <label for="is_active" class="form-check-label">
                        Tampilkan di halaman publik
                    </label>
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan Program
                </button>

                <a href="{{ route('admin.programs.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
            </form>

        </div>
    </div>
</div>
@endsection
