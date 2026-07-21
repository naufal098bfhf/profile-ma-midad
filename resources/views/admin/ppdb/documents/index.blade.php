@extends('layouts.admin')

@section('title', 'Kelola Dokumen PPDB')

@section('content')
<div class="row">
	<div class="col-12 col-xl-12 grid-margin stretch-card">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Dokumen PPDB: {{ $ppdb->title }}</h6>
					<div class="dropdown">
						<button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.create', $ppdb) }}"><i data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah Dokumen</span></a>
						</div>
					</div>
				</div>
				<div class="row align-items-start">
					<div class="col-md-7">
						<p class="text-muted tx-13 mb-3 mb-md-0">Kelola dokumen untuk PPDB "{{ $ppdb->title }}". Anda dapat menambah, mengedit, atau menghapus dokumen.</p>
					</div>
					<div class="col-md-5 d-flex justify-content-md-end">
						<a href="{{ route('admin.ppdb.documents.create', $ppdb) }}" class="btn btn-primary mb-3 mb-md-0">
							<i data-feather="plus" class="icon-sm me-2"></i>
							Tambah Dokumen
						</a>
						<a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-secondary mb-3 mb-md-0 ms-2">
							<i data-feather="arrow-left" class="icon-sm me-2"></i>
							Kembali ke PPDB
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="dataTableExample" class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Icon</th>
								<th>Nama Dokumen</th>
								<th>Deskripsi</th>
								<th>File</th>
								<th>Ukuran</th>
								<th>Status</th>
								<th>Wajib</th>
								<th>Urutan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($documents as $document)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									<i class="{{ $document->icon }} fa-2x"></i>
								</td>
								<td>
									<div>
										<h6 class="mb-0">{{ $document->name }}</h6>
										<small class="text-muted">{{ $document->file_name }}</small>
									</div>
								</td>
								<td>
									@if($document->description)
										{{ Str::limit($document->description, 50) }}
									@else
										<span class="text-muted">-</span>
									@endif
								</td>
								<td>
									<small class="text-muted">{{ strtoupper($document->extension) }}</small>
								</td>
								<td>
									<small class="text-muted">{{ $document->formatted_size }}</small>
								</td>
								<td>
									@if($document->is_active)
										<span class="badge bg-success">Aktif</span>
									@else
										<span class="badge bg-danger">Tidak Aktif</span>
									@endif
								</td>
								<td>
									@if($document->is_required)
										<span class="badge bg-warning">Wajib</span>
									@else
										<span class="badge bg-secondary">Opsional</span>
									@endif
								</td>
								<td>
									<span class="badge bg-info">{{ $document->sort_order }}</span>
								</td>
								<td>
									<div class="dropdown">
										<button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.show', [$ppdb, $document]) }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Lihat</span></a>
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.edit', [$ppdb, $document]) }}"><i data-feather="edit" class="icon-sm me-2"></i> <span class="">Edit</span></a>
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.download', [$ppdb, $document]) }}"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
											<div class="dropdown-divider"></div>
											@if($document->is_active)
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.toggle-status', [$ppdb, $document]) }}" onclick="return confirm('Nonaktifkan dokumen?')"><i data-feather="pause" class="icon-sm me-2"></i> <span class="">Nonaktifkan</span></a>
											@else
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.toggle-status', [$ppdb, $document]) }}" onclick="return confirm('Aktifkan dokumen?')"><i data-feather="play" class="icon-sm me-2"></i> <span class="">Aktifkan</span></a>
											@endif
											@if($document->is_required)
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.toggle-required', [$ppdb, $document]) }}" onclick="return confirm('Jadikan opsional?')"><i data-feather="minus-circle" class="icon-sm me-2"></i> <span class="">Jadikan Opsional</span></a>
											@else
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.toggle-required', [$ppdb, $document]) }}" onclick="return confirm('Jadikan wajib?')"><i data-feather="check-circle" class="icon-sm me-2"></i> <span class="">Jadikan Wajib</span></a>
											@endif
											<div class="dropdown-divider"></div>
											<form action="{{ route('admin.ppdb.documents.destroy', [$ppdb, $document]) }}" method="POST" class="d-inline">
												@csrf
												@method('DELETE')
												<button type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
													<i data-feather="trash-2" class="icon-sm me-2"></i> <span class="">Hapus</span>
												</button>
											</form>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('plugin-css')
<link rel="stylesheet" href="{{ asset('template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
@endpush

@push('plugin-js')
<script src="{{ asset('template/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-js')
<script>
	$(function() {
		'use strict';
		
		$('#dataTableExample').DataTable({
			"aLengthMenu": [
				[10, 30, 50, -1],
				[10, 30, 50, "All"]
			],
			"iDisplayLength": 10,
			"language": {
				search: ""
			}
		});
		$('#dataTableExample').each(function() {
			var datatable = $(this);
			// SEARCH - Add the placeholder for Search and Turn this into in-line form control
			var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
			search_input.attr('placeholder', 'Search');
			search_input.removeClass('form-control-sm');
			// LENGTH - Inline-Form control
			var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
			length_sel.removeClass('form-control-sm');
		});
	});
</script>
@endpush

