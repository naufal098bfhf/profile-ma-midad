@extends('layouts.admin')

@section('title', 'Edit FAQ PPDB')

@section('content')
<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Edit FAQ PPDB</h6>
					<button type="button" class="btn btn-outline-secondary" onclick="history.back()">
						<i data-feather="arrow-left" class="icon-sm me-2"></i>
						Kembali
					</button>
				</div>
				
				<form action="{{ route('admin.ppdb.faqs.update', [$ppdb, $faq]) }}" method="POST">
					@csrf
					@method('PUT')
					
					<div class="row">
						<div class="col-md-8">
							<div class="mb-3">
								<label for="question" class="form-label">Pertanyaan <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('question') is-invalid @enderror" 
									   id="question" name="question" value="{{ old('question', $faq->question) }}" 
									   placeholder="Contoh: Kapan pendaftaran PPDB dimulai?" required>
								@error('question')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<div class="mb-3">
								<label for="answer" class="form-label">Jawaban <span class="text-danger">*</span></label>
								<textarea class="form-control @error('answer') is-invalid @enderror" 
										  id="answer" name="answer" rows="6" 
										  placeholder="Jawaban lengkap untuk pertanyaan FAQ" required>{{ old('answer', $faq->answer) }}</textarea>
								<div class="form-text">
									Maksimal 2000 karakter. Gunakan format yang jelas dan mudah dipahami.
								</div>
								@error('answer')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h6 class="card-title mb-0">Pengaturan</h6>
								</div>
								<div class="card-body">
									<div class="mb-3">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
											<label class="form-check-label" for="is_active">
												Aktif
											</label>
										</div>
										<small class="text-muted">FAQ akan ditampilkan di halaman PPDB</small>
									</div>
									
									<div class="mb-3">
										<label for="sort_order" class="form-label">Urutan Tampil</label>
										<input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
											   id="sort_order" name="sort_order" value="{{ old('sort_order', $faq->sort_order) }}" 
											   min="0" placeholder="0">
										<small class="text-muted">Angka lebih kecil akan ditampilkan lebih dulu</small>
										@error('sort_order')
											<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<div class="d-flex justify-content-end gap-2">
								<button type="button" class="btn btn-secondary" onclick="history.back()">
									<i data-feather="x" class="icon-sm me-2"></i>
									Batal
								</button>
								<button type="submit" class="btn btn-primary">
									<i data-feather="save" class="icon-sm me-2"></i>
									Update FAQ
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
<script>
	// Character counter for answer textarea
	document.getElementById('answer').addEventListener('input', function() {
		const maxLength = 2000;
		const currentLength = this.value.length;
		const remaining = maxLength - currentLength;
		
		// Create or update counter
		let counter = document.querySelector('.char-counter');
		if (!counter) {
			counter = document.createElement('small');
			counter.className = 'char-counter text-muted';
			this.parentNode.appendChild(counter);
		}
		
		counter.textContent = `${currentLength}/${maxLength} karakter`;
		
		if (remaining < 100) {
			counter.className = 'char-counter text-warning';
		} else {
			counter.className = 'char-counter text-muted';
		}
	});
	
	// Initialize counter on page load
	document.addEventListener('DOMContentLoaded', function() {
		const textarea = document.getElementById('answer');
		const maxLength = 2000;
		const currentLength = textarea.value.length;
		
		let counter = document.createElement('small');
		counter.className = 'char-counter text-muted';
		counter.textContent = `${currentLength}/${maxLength} karakter`;
		textarea.parentNode.appendChild(counter);
	});
</script>
@endpush

