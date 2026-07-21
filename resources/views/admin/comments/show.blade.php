@extends('layouts.admin')

@section('title', 'Detail Komentar')

@section('content')
<div class="row">
	<div class="col-12 col-xl-12 grid-margin stretch-card">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Detail Komentar</h6>
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
						<p class="text-muted tx-13 mb-3 mb-md-0">Detail lengkap komentar dari {{ $comment->name }}.</p>
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

                <div class="card-body">
                    <div class="row">
                        <!-- Comment Details -->
                        <div class="col-lg-8">
                            <div class="comment-detail">
                                <!-- Comment Header -->
                                <div class="comment-header mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="comment-avatar me-3">
                                            {{ strtoupper(substr($comment->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h5 class="comment-author mb-1">{{ $comment->name }}</h5>
                                            <div class="comment-meta text-muted">
                                                @if($comment->email)
                                                    <i data-feather="mail" class="icon-sm me-1"></i>
                                                    {{ $comment->email }}
                                                    <span class="mx-2">•</span>
                                                @endif
                                                <i data-feather="calendar" class="icon-sm me-1"></i>
                                                {{ $comment->created_at->format('d M Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comment Content -->
                                <div class="comment-content mb-4">
                                    <h6 class="mb-3">Isi Komentar:</h6>
                                    <div class="comment-text p-3 bg-light rounded">
                                        {{ $comment->comment }}
                                    </div>
                                </div>

                                <!-- Comment Status -->
                                <div class="comment-status mb-4">
                                    <h6 class="mb-3">Status:</h6>
                                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input status-switch" 
                                   type="checkbox" 
                                   id="status_{{ $comment->id }}" 
                                   data-comment-id="{{ $comment->id }}"
                                   {{ $comment->is_approved ? 'checked' : '' }}
                                   onclick="toggleCommentStatus({{ $comment->id }}, this)">
                            <label class="form-check-label" for="status_{{ $comment->id }}">
                                <span class="status-text">{{ $comment->is_approved ? 'Tampil' : 'Ditolak' }}</span>
                            </label>
                        </div>
                                        
                                        @if($comment->is_spam)
                                            <span class="badge bg-warning text-dark fs-6" title="{{ $comment->spam_reason }}">
                                                <i data-feather="alert-triangle" class="icon-sm me-1"></i>Spam
                                            </span>
                                        @endif
                                    </div>
                                    
                                    @if($comment->is_spam)
                                        <div class="alert alert-warning">
                                            <i data-feather="alert-triangle" class="icon-sm me-2"></i>
                                            <strong>Alasan Spam:</strong> {{ $comment->spam_reason }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Technical Info -->
                                <div class="comment-tech-info">
                                    <h6 class="mb-3">Informasi Teknis:</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-item mb-2">
                                                <strong>IP Address:</strong>
                                                <span class="text-muted">{{ $comment->ip_address ?? 'Tidak tersedia' }}</span>
                                            </div>
                                            <div class="info-item mb-2">
                                                <strong>User Agent:</strong>
                                                <span class="text-muted small">{{ $comment->user_agent ?? 'Tidak tersedia' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item mb-2">
                                                <strong>Dibuat:</strong>
                                                <span class="text-muted">{{ $comment->created_at->format('d M Y H:i:s') }}</span>
                                            </div>
                                            <div class="info-item mb-2">
                                                <strong>Diperbarui:</strong>
                                                <span class="text-muted">{{ $comment->updated_at->format('d M Y H:i:s') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions & Article Info -->
                        <div class="col-lg-4">
                            <!-- Actions -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">
                                        <i class="fas fa-cogs me-2"></i>
                                        Aksi
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.comments.edit', $comment) }}" 
                                           class="btn btn-primary">
                                            <i data-feather="edit" class="icon-sm me-2"></i>
                                            Edit Komentar
                                        </a>
                                        
                                        @if($comment->is_approved)
                                            <button type="button" 
                                                    class="btn btn-danger" 
                                                    onclick="toggleApproval({{ $comment->id }}, false)">
                                                <i data-feather="x" class="icon-sm me-2"></i>
                                                Tolak Komentar
                                            </button>
                                        @else
                                            <button type="button" 
                                                    class="btn btn-success" 
                                                    onclick="toggleApproval({{ $comment->id }}, true)">
                                                <i data-feather="check" class="icon-sm me-2"></i>
                                                Setujui Komentar
                                            </button>
                                        @endif
                                        
                                        <button type="button" 
                                                class="btn btn-danger" 
                                                onclick="deleteComment({{ $comment->id }})">
                                            <i data-feather="trash-2" class="icon-sm me-2"></i>
                                            Hapus Komentar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Article Info -->
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">
                                        <i class="fas fa-newspaper me-2"></i>
                                        Artikel Terkait
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="article-info">
                                        <h6 class="article-title">
                                            <a href="{{ route('pena-karsa.show', $comment->penaKarsa->slug) }}" 
                                               target="_blank" 
                                               class="text-decoration-none">
                                                {{ $comment->penaKarsa->title }}
                                            </a>
                                        </h6>
                                        <div class="article-meta text-muted small">
                                            <div class="mb-1">
                                                <i data-feather="user" class="icon-sm me-1"></i>
                                                {{ $comment->penaKarsa->author_name }}
                                            </div>
                                            <div class="mb-1">
                                                <i data-feather="tag" class="icon-sm me-1"></i>
                                                {{ $comment->penaKarsa->type_display }}
                                            </div>
                                            <div class="mb-1">
                                                <i data-feather="calendar" class="icon-sm me-1"></i>
                                                {{ $comment->penaKarsa->published_at ? $comment->penaKarsa->published_at->format('d M Y') : $comment->penaKarsa->created_at->format('d M Y') }}
                                            </div>
                                            <div>
                                                <i data-feather="eye" class="icon-sm me-1"></i>
                                                {{ number_format($comment->penaKarsa->views) }} views
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
			</div>
		</div>
	</div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus komentar ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.comment-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #03aca5, #0d9488);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.comment-author {
    color: #495057;
    margin-bottom: 0;
}

.comment-meta {
    font-size: 0.9rem;
}

.comment-text {
    white-space: pre-wrap;
    word-wrap: break-word;
    line-height: 1.6;
    font-size: 1rem;
}

.info-item {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-item:last-child {
    border-bottom: none;
}

.article-title {
    font-size: 1rem;
    line-height: 1.4;
    margin-bottom: 1rem;
}

.status-switch {
    transform: scale(1.3);
}

.status-switch:checked {
    background-color: #28a745;
    border-color: #28a745;
}

.status-text {
    font-weight: 500;
    margin-left: 0.5rem;
    font-size: 1rem;
}

.article-meta div {
    margin-bottom: 0.25rem;
}

.card-header h6 {
    color: #495057;
    font-weight: 600;
}

.btn {
    font-weight: 500;
}

.badge.fs-6 {
    font-size: 0.9rem !important;
    padding: 0.5rem 0.75rem;
}
</style>
@endpush

@push('scripts')
<script>
let deleteCommentId = null;

function toggleApproval(commentId, approve) {
    const action = approve ? 'approve' : 'reject';
    const actionText = approve ? 'menyetujui' : 'menolak';
    
    if (confirm(`Apakah Anda yakin ingin ${actionText} komentar ini?`)) {
        fetch(`{{ url('admin/comments') }}/${commentId}/${action}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Terjadi kesalahan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses permintaan.');
        });
    }
}

function deleteComment(commentId) {
    deleteCommentId = commentId;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

document.getElementById('confirmDelete').addEventListener('click', function() {
    if (deleteCommentId) {
        fetch(`{{ url('admin/comments') }}/${deleteCommentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '{{ route("admin.comments.index") }}';
            } else {
                alert('Terjadi kesalahan saat menghapus komentar.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus komentar.');
        });
    }
});

// Toast notification function
function showToast(type, message) {
    // Create toast element
    const toast = $(`
        <div class="toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `);
    
    // Add to toast container
    if ($('#toast-container').length === 0) {
        $('body').append('<div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>');
    }
    
    $('#toast-container').append(toast);
    
    // Initialize and show toast
    const bsToast = new bootstrap.Toast(toast[0], {
        autohide: true,
        delay: 3000
    });
    bsToast.show();
    
    // Remove toast element after it's hidden
    toast.on('hidden.bs.toast', function() {
        $(this).remove();
    });
}

// Function for toggle comment status
window.toggleCommentStatus = function(commentId, switchElement) {
    console.log('Function called with ID:', commentId);
    
    const isApproved = switchElement.checked;
    const statusText = switchElement.parentElement.querySelector('.status-text');
    
    console.log('Approved status:', isApproved);
    
    // Update text immediately
    statusText.textContent = isApproved ? 'Tampil' : 'Ditolak';
    
    // AJAX request
    $.ajax({
        url: `{{ url('admin/comments') }}/${commentId}/${isApproved ? 'approve' : 'reject'}`,
        type: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        },
        success: function(response) {
            console.log('Response:', response);
            if (response.success) {
                console.log('Status updated successfully');
                // Show toast notification
                showToast('success', response.message || 'Status komentar berhasil diubah!');
            } else {
                // Revert switch if failed
                switchElement.checked = !isApproved;
                statusText.textContent = isApproved ? 'Ditolak' : 'Tampil';
                showToast('error', 'Terjadi kesalahan: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            // Revert switch if failed
            switchElement.checked = !isApproved;
            statusText.textContent = isApproved ? 'Ditolak' : 'Tampil';
            showToast('error', 'Terjadi kesalahan saat mengubah status komentar.');
        }
    });
};
</script>
@endpush
