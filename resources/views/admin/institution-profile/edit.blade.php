
{{-- resources/views/admin/institution-profile/edit.blade.php --}}

@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h2 class="mb-4">Profil Lembaga</h2>

    {{-- PESAN BERHASIL --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- PESAN ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.institution-profile.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- A. DATA UMUM LEMBAGA --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header fw-bold">
                <i class="bi bi-building me-2"></i>
                A. Data Umum Lembaga
            </div>

            <div class="card-body">

                @php
                    $fields = [
                        'name' => 'Nama Lembaga',
                        'nsm' => 'NSM',
                        'npsn' => 'NPSN',
                        'establishment_charter' => 'Nomor Piagam Pendirian',
                        'operational_license' => 'Nomor Izin Operasional',
                        'founded_at' => 'Tanggal/Tahun Berdiri',
                        'address' => 'Alamat',
                        'village' => 'Desa/Kelurahan',
                        'district' => 'Kecamatan',
                        'regency' => 'Kabupaten/Kota',
                        'postal_code' => 'Kode Pos',
                        'province' => 'Provinsi',
                        'accreditation' => 'Akreditasi',
                        'foundation' => 'Yayasan',
                        'email' => 'Email',
                        'phone' => 'Nomor Telepon',
                        'website' => 'Website',
                        'principal_name' => 'Nama Kepala Madrasah',
                        'principal_period' => 'Periode Kepala Madrasah',
                        'academic_year' => 'Tahun Ajaran',
                        'alumni_year' => 'Tahun Alumni',
                    ];
                @endphp

                @foreach ($fields as $field => $label)
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label fw-semibold">
                            {{ $label }}
                        </label>

                        @if ($field === 'address')
                            <textarea
                                id="{{ $field }}"
                                name="{{ $field }}"
                                class="form-control"
                                rows="3"
                            >{{ old($field, $profile->$field ?? '') }}</textarea>
                        @else
                            <input
                                type="text"
                                id="{{ $field }}"
                                name="{{ $field }}"
                                class="form-control"
                                value="{{ old($field, $profile->$field ?? '') }}"
                                {{ $field === 'name' ? 'required' : '' }}
                            >
                        @endif
                    </div>
                @endforeach

                {{-- FOTO KEPALA MADRASAH --}}
                <hr class="my-4">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-person-badge me-2"></i>
                    Foto Kepala Madrasah
                </h5>

                <div class="row align-items-start">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">
                            Preview Foto
                        </label>

                        <div>
                            <img
                                id="principalPhotoPreview"
                                src="{{ $profile->principal_photo
                                    ? asset('storage/' . $profile->principal_photo)
                                    : 'https://placehold.co/300x360?text=Foto+Kepala+Madrasah' }}"
                                alt="Foto Kepala Madrasah"
                                class="img-thumbnail"
                                style="width: 180px; height: 220px; object-fit: cover;"
                            >
                        </div>
                    </div>

                    <div class="col-md-9 mb-3">
                        <label for="principal_photo" class="form-label fw-semibold">
                            Upload Foto Kepala Madrasah
                        </label>

                        <input
                            type="file"
                            id="principal_photo"
                            name="principal_photo"
                            class="form-control @error('principal_photo') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        @error('principal_photo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted d-block mt-2">
                            Format foto: JPG, JPEG, PNG, atau WEBP.
                            Maksimal ukuran file 2 MB.
                        </small>

                        <small class="text-muted d-block">
                            Jika tidak memilih foto baru, foto sebelumnya
                            akan tetap digunakan.
                        </small>
                    </div>
                </div>

                {{-- QUOTE KEPALA MADRASAH --}}
                <div class="mt-3">
                    <label for="principal_quote" class="form-label fw-semibold">
                        <i class="bi bi-quote me-1"></i>
                        Quote / Pesan Kepala Madrasah
                    </label>

                    <textarea
                        id="principal_quote"
                        name="principal_quote"
                        class="form-control"
                        rows="4"
                        maxlength="3000"
                        placeholder="Masukkan pesan, motivasi, atau quote Kepala Madrasah..."
                    >{{ old('principal_quote', $profile->principal_quote ?? '') }}</textarea>

                    <small class="text-muted">
                        Quote ini akan ditampilkan pada bagian Kepala Madrasah
                        di halaman profil publik.
                    </small>
                </div>

            </div>
        </div>

        {{-- B. VISI DAN MISI MADRASAH --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header fw-bold">
                <i class="bi bi-bullseye me-2"></i>
                B. Visi dan Misi Madrasah
            </div>

            <div class="card-body">

                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Isi visi dan misi sesuai dokumen resmi MA Miftahul Midad.
                    Perubahan yang disimpan akan ditampilkan pada halaman
                    profil publik madrasah.
                </div>

                {{-- VISI --}}
                <div class="mb-4">
                    <label for="vision" class="form-label fw-bold">
                        <i class="bi bi-eye me-1"></i>
                        Visi Madrasah
                    </label>

                    <textarea
                        id="vision"
                        name="vision"
                        class="form-control"
                        rows="5"
                        placeholder="Masukkan visi resmi madrasah..."
                    >{{ old('vision', $profile->vision ?? '') }}</textarea>

                    <small class="text-muted">
                        Tuliskan rumusan visi madrasah secara lengkap.
                    </small>
                </div>

                {{-- MISI --}}
                <div class="mb-3">
                    <label for="mission" class="form-label fw-bold">
                        <i class="bi bi-list-check me-1"></i>
                        Misi Madrasah
                    </label>

                    <textarea
                        id="mission"
                        name="mission"
                        class="form-control"
                        rows="10"
                        placeholder="Masukkan misi madrasah, satu poin pada setiap baris..."
                    >{{ old('mission', $profile->mission ?? '') }}</textarea>

                    <small class="text-muted">
                        Pisahkan setiap poin misi dengan baris baru.
                        Nomor poin dapat ditulis langsung pada kolom ini.
                    </small>
                </div>

            </div>
        </div>

        {{-- C. DATA SISWA, ALUMNI, DAN TENAGA PENDIDIK --}}
        @php
            $groups = [
                'Data Siswa Kelas X' => [
                    'class_x_male' => 'Laki-laki',
                    'class_x_female' => 'Perempuan',
                    'class_x_rombel' => 'Jumlah Rombel',
                ],
                'Data Siswa Kelas XI' => [
                    'class_xi_male' => 'Laki-laki',
                    'class_xi_female' => 'Perempuan',
                    'class_xi_rombel' => 'Jumlah Rombel',
                ],
                'Data Siswa Kelas XII' => [
                    'class_xii_male' => 'Laki-laki',
                    'class_xii_female' => 'Perempuan',
                    'class_xii_rombel' => 'Jumlah Rombel',
                ],
                'Data Alumni' => [
                    'alumni_male' => 'Alumni Laki-laki',
                    'alumni_female' => 'Alumni Perempuan',
                ],
                'Data Tenaga Pendidik dan Kependidikan' => [
                    'staff_smu' => 'Pendidikan SMU/SMA',
                    'staff_d3' => 'Pendidikan D3',
                    'staff_s1' => 'Pendidikan S1',
                    'staff_s2' => 'Pendidikan S2',
                    'staff_s3' => 'Pendidikan S3',
                ],
            ];
        @endphp

        @foreach ($groups as $title => $groupFields)
            <div class="card mb-4 shadow-sm">
                <div class="card-header fw-bold">
                    {{ $title }}
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($groupFields as $field => $label)
                            <div class="col-md-6 mb-3">
                                <label for="{{ $field }}"
                                       class="form-label">
                                    {{ $label }}
                                </label>

                                <input
                                    type="number"
                                    min="0"
                                    id="{{ $field }}"
                                    name="{{ $field }}"
                                    class="form-control"
                                    value="{{ old($field, $profile->$field ?? 0) }}"
                                    required
                                >
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        {{-- TOMBOL SIMPAN --}}
        <div class="d-flex justify-content-end gap-2 mb-4">
            <button type="submit" class="btn btn-success btn-lg">
                <i class="bi bi-save me-2"></i>
                Simpan Profil
            </button>
        </div>

    </form>
</div>
@endsection

@push('custom-js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const photoInput = document.getElementById('principal_photo');
    const photoPreview = document.getElementById('principalPhotoPreview');

    if (photoInput && photoPreview) {
        photoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                photoPreview.src = URL.createObjectURL(file);
            }
        });
    }
});
</script>
@endpush
