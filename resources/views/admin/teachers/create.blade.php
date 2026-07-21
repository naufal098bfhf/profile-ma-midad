@extends('layouts.admin')

@section('title', 'Tambah Guru')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">

        <div class="col">

            <h3 class="fw-bold">

                Tambah Guru

            </h3>

            <p class="text-muted mb-0">

                Tambahkan data guru baru.

            </p>

        </div>

    </div>

    <form
        action="{{ route('admin.teachers.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @include('admin.teachers.form')

    </form>

</div>

@endsection
