@extends('layouts.admin')

@section('title', 'Kelola Kegiatan PPDB')

@section('content')
<div class="row">
	<div class="col-12 col-xl-12 grid-margin stretch-card">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Kegiatan PPDB: {{ $ppdb->title }}</h6>
					<div class="dropdown">
						<button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.activities.create', $ppdb) }}"><i data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah Kegiatan</span></a>
						</div>
					</div>
				</div>
				<div class="row align-items-start">
					<div class="col-md-7">
						<p class="text-muted tx-13 mb-3 mb-md-0">Kelola kegiatan untuk PPDB "{{ $ppdb->title }}". Anda dapat menambah, mengedit, atau menghapus kegiatan.</p>
					</div>
					<div class="col-md-5 d-flex justify-content-md-end">
						<a href="{{ route('admin.ppdb.activities.create', $ppdb) }}" class="btn btn-primary mb-3 mb-md-0">
							<i data-feather="plus" class="icon-sm me-2"></i>
							Tambah Kegiatan
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
								<th>Gambar</th>
								<th>Judul</th>
								<th>Deskripsi</th>
								<th>Icon</th>
								<th>Warna</th>
								<th>Status</th>
								<th>Urutan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($activities as $activity)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									@if($activity->image)
										<img src="{{ $activity->image_url }}" alt="img" class="img-xs rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
									@else
										<div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: {{ $activity->color }}; color: white; font-size: 1rem;">
											<i class="{{ $activity->icon_class }}"></i>
										</div>
									@endif
								</td>
								<td>
									<div>
										<h6 class="mb-0">{{ $activity->short_title }}</h6>
									</div>
								</td>
								<td>
									<div>
										<p class="mb-0 text-muted">{{ $activity->short_description }}</p>
									</div>
								</td>
								<td>
									<i class="{{ $activity->icon_class }}" style="color: {{ $activity->color }}; font-size: 1.2rem;"></i>
								</td>
								<td>
									<div class="d-flex align-items-center">
										<div class="color-preview me-2" style="width: 20px; height: 20px; background: {{ $activity->color }}; border-radius: 3px;"></div>
										<small class="text-muted">{{ $activity->color }}</small>
									</div>
								</td>
								<td>
									@if($activity->is_active)
										<span class="badge bg-success">Aktif</span>
									@else
										<span class="badge bg-danger">Tidak Aktif</span>
									@endif
								</td>
								<td>
									<span class="badge bg-info">{{ $activity->sort_order }}</span>
								</td>
								<td>
									<div class="dropdown">
										<button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.activities.show', [$ppdb, $activity]) }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Lihat</span></a>
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.activities.edit', [$ppdb, $activity]) }}"><i data-feather="edit" class="icon-sm me-2"></i> <span class="">Edit</span></a>
											<div class="dropdown-divider"></div>
											@if($activity->is_active)
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.activities.toggle-status', [$ppdb, $activity]) }}" onclick="return confirm('Nonaktifkan kegiatan?')"><i data-feather="pause" class="icon-sm me-2"></i> <span class="">Nonaktifkan</span></a>
											@else
												<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.ppdb.activities.toggle-status', [$ppdb, $activity]) }}" onclick="return confirm('Aktifkan kegiatan?')"><i data-feather="play" class="icon-sm me-2"></i> <span class="">Aktifkan</span></a>
											@endif
											<div class="dropdown-divider"></div>
											<form action="{{ route('admin.ppdb.activities.destroy', [$ppdb, $activity]) }}" method="POST" class="d-inline">
												@csrf
												@method('DELETE')
												<button type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
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

