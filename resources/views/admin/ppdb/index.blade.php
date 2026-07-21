@extends('layouts.admin')

@section('title', 'Kelola PPDB')

@section('content')
<div class="row">
	<div class="col-12 col-xl-12 grid-margin stretch-card">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Kelola PPDB</h6>
					<div class="dropdown">
						<button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.create') }}"><i data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah PPDB</span></a>
						</div>
					</div>
				</div>
				<div class="row align-items-start">
					<div class="col-md-7">
						<p class="text-muted tx-13 mb-3 mb-md-0">Kelola semua PPDB SMPIT Al-Itqon. Anda dapat menambah, mengedit, atau menghapus PPDB.</p>
					</div>
					<div class="col-md-5 d-flex justify-content-md-end">
						<a href="{{ route('admin.ppdb.create') }}" class="btn btn-primary mb-3 mb-md-0">
							<i data-feather="plus" class="icon-sm me-2"></i>
							Tambah PPDB
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
								<th>Gambar</th>
								<th>Judul</th>
								<th>Status</th>
								<th>Periode</th>
								<th>Biaya</th>
								<th>Kuota</th>
								<th>Featured</th>
								<th>Tanggal</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($ppdbs as $ppdb)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									@if($ppdb->hero_image)
										<img src="{{ asset('storage/' . $ppdb->hero_image) }}" alt="img" class="img-xs rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
									@else
										<div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: .8rem; font-weight: bold;">
											<i data-feather="users"></i>
										</div>
									@endif
								</td>
								<td>
									<div>
										<h6 class="mb-0">{{ Str::limit($ppdb->title, 50) }}</h6>
										<small class="text-muted">{{ Str::limit($ppdb->description, 60) }}</small>
									</div>
								</td>
								<td>
									@if($ppdb->status === 'active')
										<span class="badge bg-success">Aktif</span>
									@elseif($ppdb->status === 'inactive')
										<span class="badge bg-danger">Tidak Aktif</span>
									@else
										<span class="badge bg-warning">Draft</span>
									@endif
								</td>
								<td>
									<small class="text-muted">{{ $ppdb->registration_period }}</small>
								</td>
								<td>
									<strong>{{ $ppdb->formatted_fee }}</strong>
								</td>
								<td>
									<span class="badge bg-info">{{ $ppdb->quota }} siswa</span>
								</td>
								<td>
									@if($ppdb->is_featured)
										<span class="badge bg-warning">
											<i data-feather="star" class="icon-xs me-1"></i>Featured
										</span>
									@else
										<span class="badge bg-secondary">-</span>
									@endif
								</td>
								<td>{{ $ppdb->created_at->format('d M Y') }}</td>
								<td>
									<div class="dropdown">
										<button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.show', $ppdb) }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Lihat</span></a>
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.edit', $ppdb) }}"><i data-feather="edit" class="icon-sm me-2"></i> <span class="">Edit</span></a>
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.documents.index', $ppdb) }}"><i data-feather="file-text" class="icon-sm me-2"></i> <span class="">Kelola Dokumen</span></a>
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.faqs.index', $ppdb) }}"><i data-feather="help-circle" class="icon-sm me-2"></i> <span class="">Kelola FAQ</span></a>
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.activities.index', $ppdb) }}"><i data-feather="activity" class="icon-sm me-2"></i> <span class="">Kelola Kegiatan</span></a>
											<a class="dropdown-item d-flex align-items-center" href="{{ route('ppdb.index') }}" target="_blank"><i data-feather="external-link" class="icon-sm me-2"></i> <span class="">Preview</span></a>
											<div class="dropdown-divider"></div>
											@if($ppdb->is_featured)
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.toggle-featured', $ppdb) }}" onclick="return confirm('Hapus dari Featured?')"><i data-feather="star-off" class="icon-sm me-2"></i> <span class="">Hapus Featured</span></a>
											@else
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.toggle-featured', $ppdb) }}" onclick="return confirm('Jadikan Featured?')"><i data-feather="star" class="icon-sm me-2"></i> <span class="">Jadikan Featured</span></a>
											@endif
											@if($ppdb->status === 'active')
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.toggle-status', $ppdb) }}" onclick="return confirm('Nonaktifkan PPDB?')"><i data-feather="pause" class="icon-sm me-2"></i> <span class="">Nonaktifkan</span></a>
											@else
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.toggle-status', $ppdb) }}" onclick="return confirm('Aktifkan PPDB?')"><i data-feather="play" class="icon-sm me-2"></i> <span class="">Aktifkan</span></a>
											@endif
											<div class="dropdown-divider"></div>
											<form action="{{ route('admin.ppdb.destroy', $ppdb) }}" method="POST" class="d-inline">
												@csrf
												@method('DELETE')
												<button type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus PPDB ini?')">
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
