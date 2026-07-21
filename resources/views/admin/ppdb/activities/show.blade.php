@extends('layouts.admin')

@section('title', 'Detail Kegiatan PPDB')

@section('content')
<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Detail Kegiatan PPDB</h6>
					<div class="d-flex gap-2">
						<a href="{{ route('admin.ppdb.activities.edit', [$ppdb, $activity]) }}" class="btn btn-primary">
							<i data-feather="edit" class="icon-sm me-2"></i>
							Edit Kegiatan
						</a>
						<a href="{{ route('admin.ppdb.activities.index', $ppdb) }}" class="btn btn-outline-secondary">
							<i data-feather="arrow-left" class="icon-sm me-2"></i>
							Kembali
						</a>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">
								<h6 class="card-title mb-0">Informasi Kegiatan</h6>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-4">
										@if($activity->image)
										<div class="activity-image mb-3">
											<img src="{{ $activity->image_url }}" alt="{{ $activity->title }}" class="img-fluid rounded">
										</div>
										@else
										<div class="activity-icon text-center mb-3">
											<i class="{{ $activity->icon_class }} fa-5x" style="color: {{ $activity->color }};"></i>
										</div>
										@endif
									</div>
									<div class="col-md-8">
										<h4 class="mb-3">{{ $activity->title }}</h4>
										<div class="activity-description">
											{!! nl2br(e($activity->description)) !!}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								<h6 class="card-title mb-0">Detail Informasi</h6>
							</div>
							<div class="card-body">
								<div class="mb-3">
									<label class="form-label fw-bold">Status</label>
									<div>
										@if($activity->is_active)
											<span class="badge bg-success">Aktif</span>
										@else
											<span class="badge bg-danger">Tidak Aktif</span>
										@endif
									</div>
								</div>
								
								<div class="mb-3">
									<label class="form-label fw-bold">Urutan Tampil</label>
									<div>
										<span class="badge bg-info">{{ $activity->sort_order }}</span>
									</div>
								</div>
								
								<div class="mb-3">
									<label class="form-label fw-bold">Icon</label>
									<div>
										<i class="{{ $activity->icon_class }}" style="color: {{ $activity->color }}; font-size: 1.5rem;"></i>
										<small class="text-muted ms-2">{{ $activity->icon ?: 'fas fa-star' }}</small>
									</div>
								</div>
								
								<div class="mb-3">
									<label class="form-label fw-bold">Warna Tema</label>
									<div class="d-flex align-items-center">
										<div class="color-preview me-2" style="width: 30px; height: 30px; background: {{ $activity->color }}; border-radius: 5px;"></div>
										<small class="text-muted">{{ $activity->color }}</small>
									</div>
								</div>
								
								<div class="mb-3">
									<label class="form-label fw-bold">Dibuat</label>
									<div>
										<small class="text-muted">{{ $activity->created_at->format('d F Y, H:i') }}</small>
									</div>
								</div>
								
								<div class="mb-3">
									<label class="form-label fw-bold">Diperbarui</label>
									<div>
										<small class="text-muted">{{ $activity->updated_at->format('d F Y, H:i') }}</small>
									</div>
								</div>
								
								<div class="mb-3">
									<label class="form-label fw-bold">PPDB</label>
									<div>
										<small class="text-muted">{{ $ppdb->title }}</small>
									</div>
								</div>
							</div>
						</div>
						
						<div class="card mt-3">
							<div class="card-header">
								<h6 class="card-title mb-0">Aksi</h6>
							</div>
							<div class="card-body">
								<div class="d-grid gap-2">
									<a href="{{ route('admin.ppdb.activities.edit', [$ppdb, $activity]) }}" class="btn btn-primary">
										<i data-feather="edit" class="icon-sm me-2"></i>
										Edit Kegiatan
									</a>
									
									@if($activity->is_active)
										<a href="{{ route('admin.ppdb.activities.toggle-status', [$ppdb, $activity]) }}" 
										   class="btn btn-warning" 
										   onclick="return confirm('Nonaktifkan kegiatan?')">
											<i data-feather="pause" class="icon-sm me-2"></i>
											Nonaktifkan
										</a>
									@else
										<a href="{{ route('admin.ppdb.activities.toggle-status', [$ppdb, $activity]) }}" 
										   class="btn btn-success" 
										   onclick="return confirm('Aktifkan kegiatan?')">
											<i data-feather="play" class="icon-sm me-2"></i>
											Aktifkan
										</a>
									@endif
									
									<form action="{{ route('admin.ppdb.activities.destroy', [$ppdb, $activity]) }}" method="POST" class="d-inline">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
											<i data-feather="trash-2" class="icon-sm me-2"></i>
											Hapus Kegiatan
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-css')
<style>
	.activity-description {
		line-height: 1.6;
		font-size: 1rem;
	}
	
	.activity-image img {
		max-height: 300px;
		object-fit: cover;
	}
	
	.color-preview {
		border: 1px solid #dee2e6;
	}
</style>
@endpush

