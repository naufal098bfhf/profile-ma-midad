@extends('layouts.admin')

@section('title', 'Detail FAQ PPDB')

@section('content')
<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Detail FAQ PPDB</h6>
					<div class="d-flex gap-2">
						<a href="{{ route('admin.ppdb.faqs.edit', [$ppdb, $faq]) }}" class="btn btn-primary">
							<i data-feather="edit" class="icon-sm me-2"></i>
							Edit FAQ
						</a>
						<a href="{{ route('admin.ppdb.faqs.index', $ppdb) }}" class="btn btn-outline-secondary">
							<i data-feather="arrow-left" class="icon-sm me-2"></i>
							Kembali
						</a>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">
								<h6 class="card-title mb-0">Pertanyaan</h6>
							</div>
							<div class="card-body">
								<h5 class="mb-0">{{ $faq->question }}</h5>
							</div>
						</div>
						
						<div class="card mt-3">
							<div class="card-header">
								<h6 class="card-title mb-0">Jawaban</h6>
							</div>
							<div class="card-body">
								<div class="faq-answer-content">
									{!! nl2br(e($faq->answer)) !!}
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								<h6 class="card-title mb-0">Informasi FAQ</h6>
							</div>
							<div class="card-body">
								<div class="mb-3">
									<label class="form-label fw-bold">Status</label>
									<div>
										@if($faq->is_active)
											<span class="badge bg-success">Aktif</span>
										@else
											<span class="badge bg-danger">Tidak Aktif</span>
										@endif
									</div>
								</div>
								
								<div class="mb-3">
									<label class="form-label fw-bold">Urutan Tampil</label>
									<div>
										<span class="badge bg-info">{{ $faq->sort_order }}</span>
									</div>
								</div>
								
								<div class="mb-3">
									<label class="form-label fw-bold">Dibuat</label>
									<div>
										<small class="text-muted">{{ $faq->created_at->format('d F Y, H:i') }}</small>
									</div>
								</div>
								
								<div class="mb-3">
									<label class="form-label fw-bold">Diperbarui</label>
									<div>
										<small class="text-muted">{{ $faq->updated_at->format('d F Y, H:i') }}</small>
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
									<a href="{{ route('admin.ppdb.faqs.edit', [$ppdb, $faq]) }}" class="btn btn-primary">
										<i data-feather="edit" class="icon-sm me-2"></i>
										Edit FAQ
									</a>
									
									@if($faq->is_active)
										<a href="{{ route('admin.ppdb.faqs.toggle-status', [$ppdb, $faq]) }}" 
										   class="btn btn-warning" 
										   onclick="return confirm('Nonaktifkan FAQ?')">
											<i data-feather="pause" class="icon-sm me-2"></i>
											Nonaktifkan
										</a>
									@else
										<a href="{{ route('admin.ppdb.faqs.toggle-status', [$ppdb, $faq]) }}" 
										   class="btn btn-success" 
										   onclick="return confirm('Aktifkan FAQ?')">
											<i data-feather="play" class="icon-sm me-2"></i>
											Aktifkan
										</a>
									@endif
									
									<form action="{{ route('admin.ppdb.faqs.destroy', [$ppdb, $faq]) }}" method="POST" class="d-inline">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
											<i data-feather="trash-2" class="icon-sm me-2"></i>
											Hapus FAQ
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
	.faq-answer-content {
		line-height: 1.6;
		font-size: 1rem;
	}
</style>
@endpush

