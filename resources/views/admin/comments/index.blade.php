@extends('layouts.admin')

@section('title', 'Kelola Komentar')

@section('content')
<div class="row">
	<div class="col-12 col-xl-12 grid-margin stretch-card">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">Kelola Komentar</h6>
					<div class="dropdown">
						<button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.comments.create') }}"><i data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah Komentar</span></a>
						</div>
					</div>
				</div>
				<div class="row align-items-start">
					<div class="col-md-7">
						<p class="text-muted tx-13 mb-3 mb-md-0">Kelola semua komentar dari artikel Pena Karsa. Anda dapat menyetujui, menolak, atau menghapus komentar.</p>
					</div>
					<div class="col-md-5 d-flex justify-content-md-end">
						<a href="{{ route('admin.comments.create') }}" class="btn btn-primary mb-3 mb-md-0">
							<i data-feather="plus" class="icon-sm me-2"></i>
							Tambah Komentar
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

				<!-- Filter and Search -->
				<div class="row mb-3">
					<div class="col-md-12">
						<form method="GET" action="{{ route('admin.comments.index') }}" class="row g-3">
							<div class="col-md-3">
								<label for="status" class="form-label">Status</label>
								<select name="status" id="status" class="form-select">
									<option value="">Semua Status</option>
									<option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Tampil</option>
									<option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
								</select>
							</div>
							<div class="col-md-6">
								<label for="search" class="form-label">Cari</label>
								<input type="text" 
									   name="search" 
									   id="search" 
									   class="form-control" 
									   placeholder="Cari berdasarkan nama, email, atau komentar..."
									   value="{{ request('search') }}">
							</div>
							<div class="col-md-3">
								<label class="form-label">&nbsp;</label>
								<div class="d-flex gap-2">
									<button type="submit" class="btn btn-outline-primary">
										<i data-feather="search" class="icon-sm me-1"></i>
										Cari
									</button>
									<a href="{{ route('admin.comments.index') }}" class="btn btn-outline-secondary">
										<i data-feather="x" class="icon-sm me-1"></i>
										Reset
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>


				<!-- Comments Table -->
				<div class="table-responsive">
				@if($comments->count() > 0)
					<table id="dataTableExample" class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Komentar</th>
								<th>Artikel</th>
								<th>Status</th>
								<th>Tanggal</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($comments as $comment)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									<div class="d-flex align-items-start">
										<div class="comment-avatar me-3">
											{{ strtoupper(substr($comment->name, 0, 1)) }}
										</div>
										<div class="comment-content">
											<div class="comment-author fw-bold">{{ $comment->name }}</div>
											@if($comment->email)
												<div class="comment-email text-muted small">{{ $comment->email }}</div>
											@endif
											<div class="comment-text mt-1">
												{{ Str::limit($comment->comment, 100) }}
											</div>
										</div>
									</div>
								</td>
								<td>
									<a href="{{ route('pena-karsa.show', $comment->penaKarsa->slug) }}" 
									   target="_blank" 
									   class="text-decoration-none">
										{{ Str::limit($comment->penaKarsa->title, 50) }}
									</a>
								</td>
								<td>
									<div class="d-flex flex-column gap-2">
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
											<span class="badge bg-warning text-dark" title="{{ $comment->spam_reason }}">
												<i data-feather="alert-triangle" class="icon-sm me-1"></i>Spam
											</span>
										@endif
									</div>
								</td>
								<td>
									<div class="d-flex flex-column">
										<small class="text-muted">
											{{ $comment->created_at->format('d M Y') }}
										</small>
										<small class="text-muted">
											{{ $comment->created_at->format('H:i') }}
										</small>
									</div>
								</td>
								<td>
									<div class="dropdown">
										<button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.comments.show', $comment) }}">
												<i data-feather="eye" class="icon-sm me-2"></i>
												<span>Lihat</span>
											</a>
											<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.comments.edit', $comment) }}">
												<i data-feather="edit" class="icon-sm me-2"></i>
												<span>Edit</span>
											</a>
											@if($comment->is_approved)
												<button type="button" 
														class="dropdown-item d-flex align-items-center text-danger" 
														onclick="toggleApproval({{ $comment->id }}, false)">
													<i data-feather="x" class="icon-sm me-2"></i>
													<span>Tolak</span>
												</button>
											@else
												<button type="button" 
														class="dropdown-item d-flex align-items-center text-success" 
														onclick="toggleApproval({{ $comment->id }}, true)">
													<i data-feather="check" class="icon-sm me-2"></i>
													<span>Setujui</span>
												</button>
											@endif
											<div class="dropdown-divider"></div>
											<button type="button" 
													class="dropdown-item d-flex align-items-center text-danger" 
													onclick="deleteComment({{ $comment->id }})">
												<i data-feather="trash-2" class="icon-sm me-2"></i>
												<span>Hapus</span>
											</button>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<div class="text-center py-5">
						<i data-feather="message-circle" class="icon-lg text-muted mb-3"></i>
						<h5 class="text-muted">Tidak ada komentar</h5>
						<p class="text-muted">Belum ada komentar yang masuk.</p>
					</div>
				@endif
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
                Apakah Anda yakin ingin menghapus komentar ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
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

.comment-content {
    flex: 1;
}

.comment-author {
    color: #495057;
}

.comment-email {
    font-size: 0.85rem;
}

.comment-text {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.4;
}

.table td {
    vertical-align: middle;
}

.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
}

.status-switch {
    transform: scale(1.2);
    cursor: pointer;
}

.status-switch:checked {
    background-color: #28a745 !important;
    border-color: #28a745 !important;
}

.status-switch:focus {
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.status-text {
    font-weight: 500;
    margin-left: 0.5rem;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #28a745;
    border-color: #28a745;
}


</style>
@endpush

@push('scripts')
<script>
// Function moved to custom-js section

let deleteCommentId = null;

function toggleApproval(commentId, approve) {
    const action = approve ? 'approve' : 'reject';
    const actionText = approve ? 'menyetujui' : 'menolak';
    
    if (confirm(`Apakah Anda yakin ingin ${actionText} komentar ini?`)) {
        fetch(`{{ url('admin/comments') }}/${commentId}/${action}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
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
                location.reload();
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

</script>
@endpush
