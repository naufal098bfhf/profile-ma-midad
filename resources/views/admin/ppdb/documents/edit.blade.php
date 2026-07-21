@extends('layouts.admin')

@section('title', 'Edit Dokumen PPDB')

@section('content')
<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Edit Dokumen PPDB</h6>
					<button type="button" class="btn btn-outline-secondary" onclick="history.back()">
						<i data-feather="arrow-left" class="icon-sm me-2"></i>
						Kembali
					</button>
				</div>
				
				<form action="{{ route('admin.ppdb.documents.update', [$ppdb, $document]) }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					
					<div class="row">
						<div class="col-md-8">
							<div class="mb-3">
								<label for="name" class="form-label">Nama Dokumen <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" 
									   id="name" name="name" value="{{ old('name', $document->name) }}" 
									   placeholder="Contoh: Formulir Pendaftaran" required>
								@error('name')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<div class="mb-3">
								<label for="description" class="form-label">Deskripsi</label>
								<textarea class="form-control @error('description') is-invalid @enderror" 
										  id="description" name="description" rows="3" 
										  placeholder="Deskripsi singkat tentang dokumen ini">{{ old('description', $document->description) }}</textarea>
								@error('description')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<div class="mb-3">
								<label for="file" class="form-label">File Dokumen Baru</label>
								<input type="file" class="form-control @error('file') is-invalid @enderror" 
									   id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.zip,.rar">
								<div class="form-text">
									Kosongkan jika tidak ingin mengganti file. Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, JPEG, PNG, GIF, ZIP, RAR<br>
									Maksimal ukuran: 10MB
								</div>
								@error('file')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
								
								@if($document->file_path)
								<div class="mt-2 p-2 bg-light rounded">
									<small class="text-muted">
										<strong>File saat ini:</strong> {{ $document->file_name }}<br>
										<strong>Ukuran:</strong> {{ $document->formatted_size }}<br>
										<strong>Tipe:</strong> {{ $document->file_type }}
									</small>
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
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" id="is_required" name="is_required" value="1" {{ old('is_required', $document->is_required) ? 'checked' : '' }}>
											<label class="form-check-label" for="is_required">
												Dokumen Wajib
											</label>
										</div>
										<small class="text-muted">Dokumen ini wajib diisi oleh calon siswa</small>
									</div>
									
									<div class="mb-3">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $document->is_active) ? 'checked' : '' }}>
											<label class="form-check-label" for="is_active">
												Aktif
											</label>
										</div>
										<small class="text-muted">Dokumen akan ditampilkan di halaman PPDB</small>
									</div>
									
									<div class="mb-3">
										<label for="sort_order" class="form-label">Urutan Tampil</label>
										<input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
											   id="sort_order" name="sort_order" value="{{ old('sort_order', $document->sort_order) }}" 
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
									Update Dokumen
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
	// File input preview
	document.getElementById('file').addEventListener('change', function(e) {
		const file = e.target.files[0];
		if (file) {
			const fileSize = (file.size / 1024 / 1024).toFixed(2);
			const fileName = file.name;
			const fileType = file.type;
			
			// Show file info
			const fileInfo = document.createElement('div');
			fileInfo.className = 'mt-2 p-2 bg-light rounded';
			fileInfo.innerHTML = `
				<small class="text-muted">
					<strong>File baru:</strong> ${fileName}<br>
					<strong>Ukuran:</strong> ${fileSize} MB<br>
					<strong>Tipe:</strong> ${fileType}
				</small>
			`;
			
			// Remove previous file info
			const existingInfo = document.querySelector('.new-file-info');
			if (existingInfo) {
				existingInfo.remove();
			}
			
			fileInfo.className += ' new-file-info';
			document.getElementById('file').parentNode.appendChild(fileInfo);
		}
	});
</script>
@endpush

