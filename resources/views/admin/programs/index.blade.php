
@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Program Madrasah</h2>
            <p class="text-muted">
                Kelola seluruh program MA Miftahul Midad.
            </p>
        </div>

        <a href="{{ route('admin.programs.create') }}"
           class="btn btn-primary">
            + Tambah Program
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Kategori</th>
                        <th>Nama Program</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($programs as $program)
                        <tr>
                            <td>{{ $programs->firstItem() + $loop->index }}</td>

                            <td>
                                {{ \App\Models\Program::CATEGORIES[$program->category] ?? $program->category }}
                            </td>

                            <td>
                                <strong>{{ $program->title }}</strong>

                                @if ($program->description)
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($program->description, 100) }}
                                    </div>
                                @endif
                            </td>

                            <td>{{ $program->sort_order }}</td>

                            <td>
                                @if ($program->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Disembunyikan</span>
                                @endif
                            </td>

                            <td class="text-nowrap">
                                <a href="{{ route('admin.programs.edit', $program) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('admin.programs.destroy', $program) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Hapus program ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                Belum ada program yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-body">
            {{ $programs->links() }}
        </div>
    </div>
</div>
@endsection
