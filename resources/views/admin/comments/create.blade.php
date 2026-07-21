@extends('layouts.admin')

@section('title', 'Tambah Komentar')

@section('content')
<div class="row">
	<div class="col-12 col-xl-12 grid-margin stretch-card">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Tambah Komentar</h6>
					<div class="dropdown">
						<button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.comments.index') }}"><i data-feather="arrow-left" class="icon-sm me-2"></i> <span class="">Kembali</span></a>
						</div>
					</div>
				</div>
				<div class="row align-items-start">
					<div class="col-md-7">
						<p class="text-muted tx-13 mb-3 mb-md-0">Tambah komentar baru untuk artikel Pena Karsa.</p>
					</div>
					<div class="col-md-5 d-flex justify-content-md-end">
						<a href="{{ route('admin.comments.index') }}" class="btn btn-outline-secondary mb-3 mb-md-0">
							<i data-feather="arrow-left" class="icon-sm me-2"></i>
							Kembali
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

                <form action="{{ route('admin.comments.store') }}" method="POST">
                    @csrf
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Comment Form -->
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email <small class="text-muted">(opsional)</small></label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pena_karsa_id" class="form-label">Artikel <span class="text-danger">*</span></label>
                                    <select class="form-select @error('pena_karsa_id') is-invalid @enderror" 
                                            id="pena_karsa_id" 
                                            name="pena_karsa_id" 
                                            required>
                                        <option value="">Pilih Artikel</option>
                                        @foreach($penaKarsaArticles as $article)
                                            <option value="{{ $article->id }}" 
                                                    {{ old('pena_karsa_id') == $article->id ? 'selected' : '' }}>
                                                {{ $article->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pena_karsa_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="comment" class="form-label">Komentar <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('comment') is-invalid @enderror" 
                                              id="comment" 
                                              name="comment" 
                                              rows="6" 
                                              required>{{ old('comment') }}</textarea>
                                    <div class="form-text">Maksimal 1000 karakter</div>
                                    @error('comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_approved" 
                                               name="is_approved" 
                                               value="1"
                                               {{ old('is_approved') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_approved">
                                            Komentar Disetujui
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Preview -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            <i class="fas fa-eye me-2"></i>
                                            Preview
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="comment-preview">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="comment-avatar me-2" id="previewAvatar">
                                                    ?
                                                </div>
                                                <div>
                                                    <div class="comment-author fw-bold" id="previewName">Nama</div>
                                                    <div class="comment-email text-muted small" id="previewEmail">email@example.com</div>
                                                </div>
                                            </div>
                                            <div class="comment-text" id="previewComment">
                                                Komentar...
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Help -->
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            <i class="fas fa-question-circle me-2"></i>
                                            Bantuan
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="help-item mb-3">
                                            <strong>Status Komentar:</strong>
                                            <div class="text-muted small">
                                                Centang "Komentar Disetujui" jika komentar ini boleh langsung ditampilkan di halaman artikel.
                                            </div>
                                        </div>
                                        
                                        <div class="help-item mb-3">
                                            <strong>Validasi:</strong>
                                            <div class="text-muted small">
                                                Semua field wajib diisi. Email harus dalam format yang valid.
                                            </div>
                                        </div>
                                        
                                        <div class="help-item">
                                            <strong>Karakter:</strong>
                                            <div class="text-muted small">
                                                Komentar maksimal 1000 karakter.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
                                <i data-feather="x" class="icon-sm me-2"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="save" class="icon-sm me-2"></i>
                                Simpan Komentar
                            </button>
                        </div>
                    </div>
			</form>
		</div>
	</div>
</div>
@endsection

@push('styles')
<style>
.comment-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #03aca5, #0d9488);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.comment-preview {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.comment-author {
    color: #495057;
    font-size: 0.9rem;
    margin-bottom: 0;
}

.comment-email {
    font-size: 0.8rem;
}

.comment-text {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.4;
    white-space: pre-wrap;
    word-wrap: break-word;
}

.help-item {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.help-item:last-child {
    border-bottom: none;
}

.form-control:focus,
.form-select:focus {
    border-color: #03aca5;
    box-shadow: 0 0 0 0.2rem rgba(3, 172, 165, 0.25);
}

.form-check-input:checked {
    background-color: #03aca5;
    border-color: #03aca5;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(3, 172, 165, 0.25);
}
</style>
@endpush

@push('scripts')
<script>
// Real-time preview update
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const commentInput = document.getElementById('comment');
    
    const previewAvatar = document.getElementById('previewAvatar');
    const previewName = document.getElementById('previewName');
    const previewEmail = document.getElementById('previewEmail');
    const previewComment = document.getElementById('previewComment');
    
    function updatePreview() {
        // Update name and avatar
        const name = nameInput.value || 'Nama';
        previewName.textContent = name;
        previewAvatar.textContent = name.charAt(0).toUpperCase();
        
        // Update email
        previewEmail.textContent = emailInput.value || 'email@example.com';
        
        // Update comment
        previewComment.textContent = commentInput.value || 'Komentar...';
    }
    
    nameInput.addEventListener('input', updatePreview);
    emailInput.addEventListener('input', updatePreview);
    commentInput.addEventListener('input', updatePreview);
    
    // Character counter for comment
    const commentTextarea = document.getElementById('comment');
    const maxLength = 1000;
    
    commentTextarea.addEventListener('input', function() {
        const remaining = maxLength - this.value.length;
        const formText = this.parentNode.querySelector('.form-text');
        
        if (remaining < 0) {
            this.value = this.value.substring(0, maxLength);
            formText.textContent = 'Maksimal 1000 karakter (0 tersisa)';
            formText.className = 'form-text text-danger';
        } else {
            formText.textContent = `${remaining} karakter tersisa`;
            formText.className = 'form-text text-muted';
        }
    });
});
</script>
@endpush
