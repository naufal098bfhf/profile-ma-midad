@extends('layouts.admin')

@section('title', 'Edit Kegiatan PPDB')

@section('content')
<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Edit Kegiatan PPDB</h6>
					<button type="button" class="btn btn-outline-secondary" onclick="history.back()">
						<i data-feather="arrow-left" class="icon-sm me-2"></i>
						Kembali
					</button>
				</div>
				
				<form action="{{ route('admin.ppdb.activities.update', [$ppdb, $activity]) }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					
					<div class="row">
						<div class="col-md-8">
							<div class="mb-3">
								<label for="title" class="form-label">Judul Kegiatan <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('title') is-invalid @enderror" 
									   id="title" name="title" value="{{ old('title', $activity->title) }}" 
									   placeholder="Contoh: Ekstrakurikuler Olahraga" required>
								@error('title')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<div class="mb-3">
								<label for="description" class="form-label">Deskripsi Kegiatan <span class="text-danger">*</span></label>
								<textarea class="form-control @error('description') is-invalid @enderror" 
										  id="description" name="description" rows="4" 
										  placeholder="Deskripsi lengkap tentang kegiatan ini" required>{{ old('description', $activity->description) }}</textarea>
								<div class="form-text">
									Maksimal 1000 karakter. Jelaskan kegiatan secara detail dan menarik.
								</div>
								@error('description')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<div class="mb-3">
								<label for="image" class="form-label">Gambar Kegiatan Baru</label>
								<input type="file" class="form-control @error('image') is-invalid @enderror" 
									   id="image" name="image" accept="image/*">
								<div class="form-text">
									Kosongkan jika tidak ingin mengganti gambar. Format: JPG, PNG, GIF. Maksimal 2MB.
								</div>
								@error('image')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
								
								@if($activity->image)
								<div class="mt-2">
									<label class="form-label">Gambar Saat Ini:</label>
									<div class="current-image">
										<img src="{{ $activity->image_url }}" alt="Current image" class="img-thumbnail" style="max-width: 200px;">
									</div>
								</div>
								@endif
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h6 class="card-title mb-0">Pengaturan</h6>
								</div>
								<div class="card-body">
									<div class="mb-3">
										<label for="icon" class="form-label">Icon Kegiatan</label>
										<input type="text" class="form-control @error('icon') is-invalid @enderror" 
											   id="icon" name="icon" value="{{ old('icon', $activity->icon) }}" 
											   placeholder="fas fa-star">
										<div class="form-text">
											<small class="text-muted">Gunakan Font Awesome class, contoh: fas fa-star, fas fa-futbol, fas fa-music</small>
										</div>
										@error('icon')
											<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
									
									<div class="mb-3">
										<label for="color" class="form-label">Warna Tema</label>
										<div class="input-group">
											<input type="color" class="form-control form-control-color" 
												   id="color" name="color" value="{{ old('color', $activity->color) }}">
											<input type="text" class="form-control" 
												   id="color-text" value="{{ old('color', $activity->color) }}" 
												   placeholder="#007bff">
										</div>
										<div class="form-text">
											<small class="text-muted">Pilih warna yang sesuai dengan tema kegiatan</small>
										</div>
										@error('color')
											<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
									
									<div class="mb-3">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $activity->is_active) ? 'checked' : '' }}>
											<label class="form-check-label" for="is_active">
												Aktif
											</label>
										</div>
										<small class="text-muted">Kegiatan akan ditampilkan di halaman PPDB</small>
									</div>
									
									<div class="mb-3">
										<label for="sort_order" class="form-label">Urutan Tampil</label>
										<input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
											   id="sort_order" name="sort_order" value="{{ old('sort_order', $activity->sort_order) }}" 
											   min="0" placeholder="0">
										<small class="text-muted">Angka lebih kecil akan ditampilkan lebih dulu</small>
										@error('sort_order')
											<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								</div>
							</div>
							
							<div class="card mt-3">
								<div class="card-header">
									<h6 class="card-title mb-0">Preview</h6>
								</div>
								<div class="card-body">
									<div class="activity-preview text-center">
										@if($activity->image)
										<div class="activity-image mb-3">
											<img src="{{ $activity->image_url }}" alt="Preview" class="img-fluid rounded" style="max-height: 150px;">
										</div>
										@else
										<div class="activity-icon mb-3" id="preview-icon">
											<i class="{{ $activity->icon_class }} fa-3x" style="color: {{ $activity->color }};"></i>
										</div>
										@endif
										<h6 id="preview-title" class="mb-2">{{ $activity->title }}</h6>
										<p id="preview-description" class="text-muted small mb-0">{{ $activity->description }}</p>
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
									Update Kegiatan
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
	// Character counter for description textarea
	document.getElementById('description').addEventListener('input', function() {
		const maxLength = 1000;
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
	
	// Color picker synchronization
	document.getElementById('color').addEventListener('input', function() {
		document.getElementById('color-text').value = this.value;
		updatePreview();
	});
	
	document.getElementById('color-text').addEventListener('input', function() {
		document.getElementById('color').value = this.value;
		updatePreview();
	});
	
	// Icon input change
	document.getElementById('icon').addEventListener('input', updatePreview);
	
	// Title input change
	document.getElementById('title').addEventListener('input', updatePreview);
	
	// Description input change
	document.getElementById('description').addEventListener('input', updatePreview);
	
	// Image preview
	document.getElementById('image').addEventListener('change', function(e) {
		const file = e.target.files[0];
		if (file) {
			const reader = new FileReader();
			reader.onload = function(e) {
				const preview = document.querySelector('.activity-preview');
				preview.innerHTML = `
					<div class="activity-image mb-3">
						<img src="${e.target.result}" alt="Preview" class="img-fluid rounded" style="max-height: 150px;">
					</div>
					<h6 id="preview-title" class="mb-2">${document.getElementById('title').value || 'Judul Kegiatan'}</h6>
					<p id="preview-description" class="text-muted small mb-0">${document.getElementById('description').value || 'Deskripsi kegiatan akan muncul di sini'}</p>
				`;
			};
			reader.readAsDataURL(file);
		}
	});
	
	function updatePreview() {
		const title = document.getElementById('title').value || 'Judul Kegiatan';
		const description = document.getElementById('description').value || 'Deskripsi kegiatan akan muncul di sini';
		const icon = document.getElementById('icon').value || 'fas fa-star';
		const color = document.getElementById('color').value || '#007bff';
		
		document.getElementById('preview-title').textContent = title;
		document.getElementById('preview-description').textContent = description;
		
		const iconElement = document.querySelector('#preview-icon i');
		if (iconElement) {
			iconElement.className = icon + ' fa-3x';
			iconElement.style.color = color;
		}
	}
	
	// Initialize counter on page load
	document.addEventListener('DOMContentLoaded', function() {
		const textarea = document.getElementById('description');
		const maxLength = 1000;
		const currentLength = textarea.value.length;
		
		let counter = document.createElement('small');
		counter.className = 'char-counter text-muted';
		counter.textContent = `${currentLength}/${maxLength} karakter`;
		textarea.parentNode.appendChild(counter);
	});
</script>
@endpush

