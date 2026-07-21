@extends('layouts.admin')

@section('title', 'Edit Guru')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">

        <div class="col">

            <h3 class="fw-bold">

                Edit Guru

            </h3>

            <p class="text-muted mb-0">

                Perbarui data guru.

            </p>

        </div>

    </div>

    <form
        action="{{ route('admin.teachers.update', $teacher) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        @method('PUT')

        @include('admin.teachers.form')

    </form>

</div>

@endsection
