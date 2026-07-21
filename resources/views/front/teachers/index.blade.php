@extends('layouts.app')

@section('title', 'Tenaga Pendidik')

@section('content')

{{-- Hero --}}
<section class="py-5 bg-light border-bottom">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8 text-center">

                <span class="badge bg-danger px-3 py-2 mb-3">
                    MA MIFTAHUL MIDAD
                </span>

                <h1 class="fw-bold display-5 mb-3">

                    Tenaga Pendidik Kami

                </h1>

                <p class="text-muted fs-5">

                    Guru-guru profesional yang berdedikasi membimbing peserta didik
                    menjadi generasi berilmu, berakhlak mulia, dan siap menghadapi
                    tantangan masa depan.

                </p>

            </div>

        </div>

    </div>

</section>

{{-- Guru --}}
<section class="py-5">

    <div class="container">

        <div class="row g-4">

            @forelse($teachers as $teacher)

                <div class="col-lg-3 col-md-6">

                    <div class="card border-0 shadow-sm h-100 teacher-card">

                        <div class="overflow-hidden">

                            <img
                                src="{{ $teacher->photo_url }}"
                                class="card-img-top"
                                style="height:320px;object-fit:cover;"
                                loading="lazy">

                        </div>

                        <div class="card-body text-center">

                            <h5 class="fw-bold mb-1">

                                {{ $teacher->name }}

                            </h5>

                            <span class="badge bg-primary mb-3">

                                {{ $teacher->position }}

                            </span>

                            <p class="mb-1">

                                <i class="fas fa-book text-danger"></i>

                                {{ $teacher->subject }}

                            </p>

                            <p class="text-muted small">

                                {{ $teacher->education }}

                            </p>

                        </div>

                        <div class="card-footer bg-white border-0 text-center pb-4">

                            <a
                                href="{{ route('teachers.show',$teacher) }}"
                                class="btn btn-danger rounded-pill px-4">

                                Lihat Profil

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-warning text-center">

                        Belum ada data guru.

                    </div>

                </div>

            @endforelse

        </div>

        <div class="mt-5">

            {{ $teachers->links() }}

        </div>

    </div>

</section>

@endsection

@push('styles')

<style>

.teacher-card{

transition:.35s;

border-radius:18px;

overflow:hidden;

}

.teacher-card:hover{

transform:translateY(-10px);

box-shadow:0 20px 45px rgba(0,0,0,.15)!important;

}

.teacher-card img{

transition:.5s;

}

.teacher-card:hover img{

transform:scale(1.08);

}

</style>

@endpush
