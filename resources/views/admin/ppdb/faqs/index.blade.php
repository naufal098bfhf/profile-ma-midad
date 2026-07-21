@extends('layouts.admin')

@section('title', 'Kelola FAQ PPDB')

@section('content')
<div class="row">
	<div class="col-12 col-xl-12 grid-margin stretch-card">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">FAQ PPDB: {{ $ppdb->title }}</h6>
					<div class="dropdown">
						<button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.faqs.create', $ppdb) }}"><i data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah FAQ</span></a>
						</div>
					</div>
				</div>
				<div class="row align-items-start">
					<div class="col-md-7">
						<p class="text-muted tx-13 mb-3 mb-md-0">Kelola FAQ untuk PPDB "{{ $ppdb->title }}". Anda dapat menambah, mengedit, atau menghapus FAQ.</p>
					</div>
					<div class="col-md-5 d-flex justify-content-md-end">
						<a href="{{ route('admin.ppdb.faqs.create', $ppdb) }}" class="btn btn-primary mb-3 mb-md-0">
							<i data-feather="plus" class="icon-sm me-2"></i>
							Tambah FAQ
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
								<th>Pertanyaan</th>
								<th>Jawaban</th>
								<th>Status</th>
								<th>Urutan</th>
								<th>Dibuat</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($faqs as $faq)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									<div>
										<h6 class="mb-0">{{ $faq->short_question }}</h6>
									</div>
								</td>
								<td>
									<div>
										<p class="mb-0 text-muted">{{ $faq->short_answer }}</p>
									</div>
								</td>
								<td>
									@if($faq->is_active)
										<span class="badge bg-success">Aktif</span>
									@else
										<span class="badge bg-danger">Tidak Aktif</span>
									@endif
								</td>
								<td>
									<span class="badge bg-info">{{ $faq->sort_order }}</span>
								</td>
								<td>
									<small class="text-muted">{{ $faq->created_at->format('d M Y') }}</small>
								</td>
								<td>
									<div class="dropdown">
										<button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.faqs.show', [$ppdb, $faq]) }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Lihat</span></a>
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.faqs.edit', [$ppdb, $faq]) }}"><i data-feather="edit" class="icon-sm me-2"></i> <span class="">Edit</span></a>
											<div class="dropdown-divider"></div>
											@if($faq->is_active)
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.faqs.toggle-status', [$ppdb, $faq]) }}" onclick="return confirm('Nonaktifkan FAQ?')"><i data-feather="pause" class="icon-sm me-2"></i> <span class="">Nonaktifkan</span></a>
											@else
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.faqs.toggle-status', [$ppdb, $faq]) }}" onclick="return confirm('Aktifkan FAQ?')"><i data-feather="play" class="icon-sm me-2"></i> <span class="">Aktifkan</span></a>
											@endif
											<div class="dropdown-divider"></div>
											<form action="{{ route('admin.ppdb.faqs.destroy', [$ppdb, $faq]) }}" method="POST" class="d-inline">
												@csrf
												@method('DELETE')
												<button type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
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

