<!-- Custom Style untuk Announcements Widget Premium -->
<style>
    /* Section Container */
    .announcements-widget {
        background: #f8fafc;
        padding: 4.5rem 0;
        position: relative;
    }

    /* Header Styling */
    .announcements-widget .widget-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        border-bottom: 2px solid rgba(226, 232, 240, 0.8);
        padding-bottom: 1rem;
    }

    .announcements-widget .widget-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .announcements-widget .widget-title i {
        color: #0d6efd;
        background: rgba(13, 110, 253, 0.1);
        padding: 0.6rem;
        border-radius: 12px;
        font-size: 1.25rem;
    }

    /* View All Button */
    .announcements-widget .view-all-btn {
        font-weight: 600;
        font-size: 0.95rem;
        color: #0d6efd;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        border-radius: 50rem;
        background: #ffffff;
        border: 1px solid rgba(13, 110, 253, 0.2);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        transition: all 0.25s ease;
    }

    .announcements-widget .view-all-btn:hover {
        background: #0d6efd;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        transform: translateY(-2px);
    }

    .announcements-widget .view-all-btn i {
        transition: transform 0.2s ease;
    }

    .announcements-widget .view-all-btn:hover i {
        transform: translateX(3px);
    }

    /* Card Styling */
    .announcements-widget .announcement-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
    }

    .announcements-widget .announcement-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.03);
        border-color: rgba(13, 110, 253, 0.3);
    }

    /* Card Header */
    .announcements-widget .card-header {
        background: transparent;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem 1.5rem 0.75rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .announcements-widget .announcement-meta {
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
    }

    .announcements-widget .badge {
        font-weight: 600;
        font-size: 0.75rem;
        padding: 0.35em 0.75em;
        border-radius: 6px;
        letter-spacing: 0.02em;
    }

    .announcements-widget .announcement-date {
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    /* Card Body */
    .announcements-widget .card-body {
        padding: 1.25rem 1.5rem 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .announcements-widget .announcement-title {
        font-size: 1.15rem;
        font-weight: 700;
        line-height: 1.45;
        margin-bottom: 0.75rem;
    }

    .announcements-widget .announcement-title a {
        color: #1e293b;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .announcements-widget .announcement-title a:hover {
        color: #0d6efd;
    }

    .announcements-widget .announcement-summary {
        color: #4b5563;
        font-size: 0.925rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    /* Card Footer Buttons */
    .announcements-widget .announcement-footer {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-top: 1rem;
        border-top: 1px dashed #e2e8f0;
    }

    .announcements-widget .btn-primary {
        background: #0d6efd;
        border: none;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        flex-grow: 1;
        justify-content: center;
    }

    .announcements-widget .btn-primary:hover {
        background: #0b5ed7;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.25);
    }

    .announcements-widget .btn-outline-success {
        border-color: rgba(25, 135, 84, 0.3);
        color: #198754;
        font-weight: 600;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .announcements-widget .btn-outline-success:hover {
        background: #198754;
        color: #ffffff;
        border-color: #198754;
        box-shadow: 0 4px 10px rgba(25, 135, 84, 0.2);
    }

    /* Empty State */
    .announcements-widget .empty-state {
        background: #ffffff;
        border-radius: 16px;
        border: 2px dashed #cbd5e1;
        padding: 4rem 1rem;
    }
</style>

<!-- Announcements Widget -->
<div class="announcements-widget">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="widget-header">
                    <h3 class="widget-title">
                        <i class="fas fa-bullhorn"></i>
                        Pengumuman Terbaru
                    </h3>
                    @if(isset($announcements) && count($announcements) > 0)
                    <a href="{{ route('announcements.index') }}" class="view-all-btn">
                        Lihat Semua <i class="fas fa-arrow-right"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row d-flex align-items-stretch">
            @forelse($announcements as $announcement)
            <div class="col-lg-4 col-md-6 mb-4 d-flex">
                <div class="announcement-card w-100">
                    <div class="card-header">
                        <div class="announcement-meta">
                            <span class="badge bg-{{ $announcement->priority_color }}">
                                {{ $announcement->priority_label }}
                            </span>
                            <span class="badge bg-secondary">{{ $announcement->category_label }}</span>
                        </div>
                        <small class="announcement-date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $announcement->published_at->format('d M Y') }}
                        </small>
                    </div>

                    <div class="card-body">
                        <h5 class="announcement-title">
                           <a href="{{ route('announcements.show', $announcement->slug) }}">
                                {{ Str::limit($announcement->title, 60) }}
                            </a>
                        </h5>

                        <p class="announcement-summary">
                            {{ Str::limit($announcement->summary, 100) }}
                        </p>

                        <div class="announcement-footer">
                            <a href="{{ route('announcements.show', $announcement->slug) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Baca Selengkapnya
                            </a>

                            @if($announcement->attachment)
                            <a href="{{ $announcement->attachment }}" target="_blank" class="btn btn-sm btn-outline-success" title="Unduh Lampiran">
                                <i class="fas fa-download"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state text-center">
                    <i class="fas fa-bullhorn fa-3x text-secondary opacity-50 mb-3"></i>
                    <h6 class="fw-bold text-dark mb-1">Belum Ada Pengumuman</h6>
                    <p class="text-muted mb-0 small">Pengumuman atau informasi terbaru akan ditampilkan di sini.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
