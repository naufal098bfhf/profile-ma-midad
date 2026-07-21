<div class="comment-list-container">
    <div class="comment-list-header">
        <h5 class="comment-list-title">
            <i class="fas fa-comments me-2"></i>
            Komentar (<span id="commentCount">0</span>)
        </h5>
    </div>

    <div id="commentsList" class="comments-list">
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Memuat komentar...</span>
            </div>
            <p class="mt-2 text-muted">Memuat komentar...</p>
        </div>
    </div>

    <div id="noComments" class="no-comments d-none">
        <div class="text-center py-5">
            <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
            <h6 class="text-muted">Belum ada komentar</h6>
            <p class="text-muted">Jadilah yang pertama memberikan komentar!</p>
        </div>
    </div>
</div>

<style>
.comment-list-container {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(3, 172, 165, 0.1);
    padding: 2rem;
    margin-bottom: 2rem;
}

.comment-list-header {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e9ecef;
}

.comment-list-title {
    color: #03aca5;
    font-weight: 600;
    margin-bottom: 0;
}

.comments-list {
    min-height: 100px;
}

.comment-item {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border-left: 4px solid #03aca5;
    transition: all 0.3s ease;
}

.comment-item:hover {
    box-shadow: 0 2px 8px rgba(3, 172, 165, 0.15);
    transform: translateY(-1px);
}

.comment-header {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

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
    margin-right: 1rem;
    flex-shrink: 0;
}

.comment-author {
    flex: 1;
}

.comment-author-name {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.25rem;
}

.comment-date {
    font-size: 0.85rem;
    color: #6c757d;
}

.comment-content {
    color: #495057;
    line-height: 1.6;
    margin-bottom: 0;
    white-space: pre-wrap;
    word-wrap: break-word;
}

.no-comments {
    text-align: center;
    padding: 3rem 1rem;
}

.comment-loading {
    text-align: center;
    padding: 2rem;
}

.comment-error {
    text-align: center;
    padding: 2rem;
    color: #dc3545;
}

@media (max-width: 768px) {
    .comment-list-container {
        padding: 1.5rem;
    }
    
    .comment-item {
        padding: 1rem;
    }
    
    .comment-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .comment-avatar {
        margin-right: 0;
        margin-bottom: 0.75rem;
    }
}
</style>

<script>
function loadComments() {
    const commentsList = document.getElementById('commentsList');
    const noComments = document.getElementById('noComments');
    const commentCount = document.getElementById('commentCount');
    
    // Show loading state
    commentsList.innerHTML = `
        <div class="comment-loading">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Memuat komentar...</span>
            </div>
            <p class="mt-2 text-muted">Memuat komentar...</p>
        </div>
    `;
    
    // Fetch comments
    fetch(`{{ route('comments.get', $penaKarsaId) }}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const comments = data.comments;
            commentCount.textContent = comments.length;
            
            if (comments.length === 0) {
                commentsList.classList.add('d-none');
                noComments.classList.remove('d-none');
            } else {
                commentsList.classList.remove('d-none');
                noComments.classList.add('d-none');
                
                commentsList.innerHTML = comments.map(comment => `
                    <div class="comment-item">
                        <div class="comment-header">
                            <div class="comment-avatar">
                                ${comment.name.charAt(0).toUpperCase()}
                            </div>
                            <div class="comment-author">
                                <div class="comment-author-name">${escapeHtml(comment.name)}</div>
                                ${comment.email ? `<div class="comment-email text-muted small">${escapeHtml(comment.email)}</div>` : ''}
                                <div class="comment-date">
                                    <i class="fas fa-clock me-1"></i>
                                    ${formatDate(comment.created_at)}
                                </div>
                            </div>
                        </div>
                        <div class="comment-content">${escapeHtml(comment.comment)}</div>
                    </div>
                `).join('');
            }
        } else {
            commentsList.innerHTML = `
                <div class="comment-error">
                    <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                    <p>Gagal memuat komentar. Silakan refresh halaman.</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error loading comments:', error);
        commentsList.innerHTML = `
            <div class="comment-error">
                <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                <p>Gagal memuat komentar. Silakan refresh halaman.</p>
            </div>
        `;
    });
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);
    
    if (diffInSeconds < 60) {
        return 'Baru saja';
    } else if (diffInSeconds < 3600) {
        const minutes = Math.floor(diffInSeconds / 60);
        return `${minutes} menit yang lalu`;
    } else if (diffInSeconds < 86400) {
        const hours = Math.floor(diffInSeconds / 3600);
        return `${hours} jam yang lalu`;
    } else if (diffInSeconds < 2592000) {
        const days = Math.floor(diffInSeconds / 86400);
        return `${days} hari yang lalu`;
    } else {
        return date.toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }
}

// Load comments when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadComments();
});
</script>
