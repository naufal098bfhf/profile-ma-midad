<div class="comment-form-container">
    <div class="comment-form-header">
        <h5 class="comment-form-title">
            <i class="fas fa-comment-dots me-2"></i>
            Tinggalkan Komentar
        </h5>
        <p class="comment-form-subtitle">Bagikan pendapat Anda tentang artikel ini</p>
    </div>

    <form id="commentForm" class="comment-form">
        @csrf
        <input type="hidden" name="pena_karsa_id" value="{{ $penaKarsaId }}">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control" 
                           id="name" 
                           name="name" 
                           required 
                           maxlength="255"
                           placeholder="Masukkan nama Anda">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email <small class="text-muted">(opsional)</small></label>
                    <input type="email" 
                           class="form-control" 
                           id="email" 
                           name="email" 
                           maxlength="255"
                           placeholder="Masukkan email Anda (opsional)">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="comment" class="form-label">Komentar <span class="text-danger">*</span></label>
            <textarea class="form-control" 
                      id="comment" 
                      name="comment" 
                      rows="4" 
                      required 
                      maxlength="1000"
                      placeholder="Tulis komentar Anda di sini..."></textarea>
            <div class="form-text">Maksimal 1000 karakter</div>
            <div class="invalid-feedback"></div>
        </div>


        <div class="form-group mb-3">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Panduan Komentar:</strong>
                <ul class="mb-0 mt-2 small">
                    <li>Gunakan bahasa yang sopan dan santun</li>
                    <li>Hindari kata-kata kotor, SARA, atau spam</li>
                    <li>Jangan menyertakan link atau URL</li>
                    <li>Komentar akan ditampilkan langsung jika sesuai aturan</li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary comment-submit-btn">
                <span class="btn-text">
                    <i class="fas fa-paper-plane me-2"></i>
                    Kirim Komentar
                </span>
                <span class="btn-loading d-none">
                    <i class="fas fa-spinner fa-spin me-2"></i>
                    Mengirim...
                </span>
            </button>
        </div>
    </form>

    <div id="commentAlert" class="alert d-none mt-3"></div>
</div>

<style>
.comment-form-container {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    border: 1px solid #e9ecef;
    margin-bottom: 2rem;
}

.comment-form-header {
    margin-bottom: 1.5rem;
}

.comment-form-title {
    color: #03aca5;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.comment-form-subtitle {
    color: #6c757d;
    margin-bottom: 0;
    font-size: 0.95rem;
}

.comment-form .form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
}

.comment-form .form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.comment-form .form-control:focus {
    border-color: #03aca5;
    box-shadow: 0 0 0 0.2rem rgba(3, 172, 165, 0.25);
}

.comment-form .form-control.is-invalid {
    border-color: #dc3545;
}

.comment-form .form-control.is-valid {
    border-color: #28a745;
}

.comment-submit-btn {
    background: linear-gradient(135deg, #03aca5, #0d9488);
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.comment-submit-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #0d9488, #0f766e);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(3, 172, 165, 0.3);
}

.comment-submit-btn:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.comment-form .form-check-input:checked {
    background-color: #03aca5;
    border-color: #03aca5;
}

.comment-form .form-check-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(3, 172, 165, 0.25);
}

#commentAlert {
    border-radius: 8px;
}

@media (max-width: 768px) {
    .comment-form-container {
        padding: 1.5rem;
    }
    
    .comment-form-title {
        font-size: 1.1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('commentForm');
    const submitBtn = form.querySelector('.comment-submit-btn');
    const alertDiv = document.getElementById('commentAlert');
    
    // Enable submit button by default
    submitBtn.disabled = false;
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous alerts
        alertDiv.classList.add('d-none');
        alertDiv.innerHTML = '';
        
        // Remove previous validation classes
        form.querySelectorAll('.form-control').forEach(input => {
            input.classList.remove('is-invalid', 'is-valid');
        });
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.querySelector('.btn-text').classList.add('d-none');
        submitBtn.querySelector('.btn-loading').classList.remove('d-none');
        
        // Get form data
        const formData = new FormData(form);
        
        // Submit via AJAX
        fetch('{{ route("comments.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                showAlert('success', data.message);
                
                // Reset form
                form.reset();
                submitBtn.disabled = true;
                
                // Reload comments
                loadComments();
            } else {
                // Show error message
                showAlert('danger', data.message);
                
                // Show validation errors
                if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        const input = form.querySelector(`[name="${field}"]`);
                        if (input) {
                            input.classList.add('is-invalid');
                            const feedback = input.parentNode.querySelector('.invalid-feedback');
                            if (feedback) {
                                feedback.textContent = data.errors[field][0];
                            }
                        }
                    });
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'Terjadi kesalahan saat mengirim komentar. Silakan coba lagi.');
        })
        .finally(() => {
            // Hide loading state
            submitBtn.disabled = false;
            submitBtn.querySelector('.btn-text').classList.remove('d-none');
            submitBtn.querySelector('.btn-loading').classList.add('d-none');
        });
    });
    
    function showAlert(type, message) {
        alertDiv.className = `alert alert-${type}`;
        alertDiv.innerHTML = message;
        alertDiv.classList.remove('d-none');
        alertDiv.classList.add('mt-3');
        
        // Scroll to alert
        alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>
