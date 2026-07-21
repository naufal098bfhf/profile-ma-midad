<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ShortlinkController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Front\TeacherController as FrontTeacherController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Dashboard route (redirect to admin dashboard)
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Articles listing page
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Article detail page dengan slug
Route::get('/article/{slug}', [ArticleController::class, 'showBySlug'])->name('article.detail');

// Pena Karsa routes
Route::get('/pena-karsa', [\App\Http\Controllers\PenaKarsaController::class, 'index'])->name('pena-karsa.index');
Route::get('/pena-karsa/{slug}', [\App\Http\Controllers\PenaKarsaController::class, 'show'])->name('pena-karsa.show');

// Category page
Route::get('/category/{slug}', [ArticleController::class, 'showByCategory'])->name('category.show');

// Author page
Route::get('/author/{slug}', [ArticleController::class, 'showByAuthor'])->name('author.show');

// Announcements routes
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');

// Galleries routes
Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');

// Comments routes
Route::post('/api/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/api/comments/{penaKarsaId}', [CommentController::class, 'getComments'])->name('comments.get');
Route::get('/galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');

// Contact routes
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])
    ->middleware('throttle:3,15') // 3 requests per 15 minutes
    ->name('contact.store');

// PPDB routes
Route::get('/ppdb', [\App\Http\Controllers\PpdbController::class, 'index'])->name('ppdb.index');
Route::get('/ppdb/{ppdb}/download/{document}', [\App\Http\Controllers\PpdbController::class, 'downloadDocument'])->name('ppdb.download');

// Documents route (based on announcement_attachments)
Route::get('/documents', function (Request $request) {
    $query = \App\Models\AnnouncementAttachment::query()
        ->whereHas('announcement', function($q) {
            $q->published();
        });

    // Filter by category
    if ($request->filled('category')) {
        $slug = $request->category;
        $query->whereHas('announcement.category', function($q) use ($slug) {
            $q->where('slug', $slug);
        });
    }

    // Filter by file type
    if ($request->filled('file_type')) {
        $fileType = $request->file_type;
        $query->where(function($q) use ($fileType) {
            if ($fileType === 'pdf') {
                $q->where('file_type', 'LIKE', 'pdf')
                  ->orWhere('file_url', 'LIKE', '%.pdf');
            } elseif ($fileType === 'doc') {
                $q->where('file_type', 'LIKE', 'doc%')
                  ->orWhere('file_url', 'LIKE', '%.doc')
                  ->orWhere('file_url', 'LIKE', '%.docx');
            } elseif ($fileType === 'xls') {
                $q->where('file_type', 'LIKE', 'xls%')
                  ->orWhere('file_url', 'LIKE', '%.xls')
                  ->orWhere('file_url', 'LIKE', '%.xlsx');
            } elseif ($fileType === 'ppt') {
                $q->where('file_type', 'LIKE', 'ppt%')
                  ->orWhere('file_url', 'LIKE', '%.ppt')
                  ->orWhere('file_url', 'LIKE', '%.pptx');
            }
        });
    }

    // Search by title
    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('announcement', function($q) use ($search) {
            $q->where('title', 'LIKE', '%' . $search . '%');
        });
    }

    $attachments = $query->latest('id')
        ->paginate(8)
        ->withQueryString();

    $documents = $attachments->through(function ($att) {
        // Detect extension
        $fileExtension = strtolower(pathinfo(parse_url($att->file_url, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION));

        // Prefer stored size; fallback to local file size if applicable
        $fileSizeBytes = $att->file_size ?: 0;
        if (!$fileSizeBytes) {
            $pathPart = parse_url($att->file_url, PHP_URL_PATH) ?: '';
            $filePath = public_path(ltrim($pathPart, '/'));
            if (is_string($filePath) && file_exists($filePath)) {
                $fileSizeBytes = filesize($filePath) ?: 0;
            }
        }
        // Format size
        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $fileSizeBytes; $i = 0;
        while ($size > 1024 && $i < count($units) - 1) { $size /= 1024; $i++; }
        $fileSizeHuman = $fileSizeBytes ? (round($size, 1) . ' ' . $units[$i]) : '-';

        return (object) [
            'id' => $att->id,
            'title' => $att->announcement->title,
            'description' => $att->announcement->summary,
            'file_url' => $att->file_url,
            'file_type' => $fileExtension ?: ($att->file_type ?: ''),
            'file_size' => $fileSizeHuman,
            'category_label' => $att->announcement->category_label,
            'announcement_slug' => $att->announcement->slug,
            'published_at' => $att->announcement->published_at,
        ];
    });

    // Get filter options
    $categories = \App\Models\AnnouncementCategory::whereHas('announcements', function($q) {
            $q->published()->whereHas('attachments');
        })
        ->active()
        ->ordered()
        ->get()
        ->map(function($category) {
            return [
                'value' => $category->slug,
                'label' => $category->name
            ];
        });

    $fileTypes = [
        ['value' => 'pdf', 'label' => 'PDF'],
        ['value' => 'doc', 'label' => 'Word (DOC/DOCX)'],
        ['value' => 'xls', 'label' => 'Excel (XLS/XLSX)'],
        ['value' => 'ppt', 'label' => 'PowerPoint (PPT/PPTX)'],
    ];

    return view('documents.index', compact('documents', 'categories', 'fileTypes'));
})->name('documents.index');

// Shortlink routes
Route::get('/s/{code}', [ShortlinkController::class, 'redirect'])->name('shortlink.redirect');

// Admin routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/top-pages', [AdminDashboardController::class, 'getTopPages'])->name('dashboard.top-pages');
    Route::get('/dashboard/visitor-stats', [AdminDashboardController::class, 'getVisitorStats'])->name('dashboard.visitor-stats');

    // Articles management
    Route::get('/articleCreate', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articleCreate', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::resource('articles', AdminArticleController::class)->except(['create', 'store']);

    // Authors management
    Route::get('/authorCreate', [AdminAuthorController::class, 'create'])->name('authors.create');
    Route::post('/authorCreate', [AdminAuthorController::class, 'store'])->name('authors.store');
    Route::resource('authors', AdminAuthorController::class)->except(['create', 'store']);

    // Article Categories management
    Route::get('/articleCategoryCreate', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('article-categories.create');
    Route::post('/articleCategoryCreate', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('article-categories.store');
    Route::resource('article-categories', \App\Http\Controllers\Admin\CategoryController::class, ['parameters' => ['article-categories' => 'category']])->except(['create', 'store']);

    // Sliders management
    Route::get('/sliderCreate', [\App\Http\Controllers\Admin\SliderController::class, 'create'])->name('sliders.create');
    Route::post('/sliderCreate', [\App\Http\Controllers\Admin\SliderController::class, 'store'])->name('sliders.store');
    Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class)->except(['create', 'store']);

    // Announcements management
    Route::get('/announcementCreate', [AdminAnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcementCreate', [AdminAnnouncementController::class, 'store'])->name('announcements.store');
    Route::post('/announcements/category', [AdminAnnouncementController::class, 'storeCategory'])->name('announcements.category.store');
    Route::delete('/announcements/{announcement}/attachments/{attachment}', [AdminAnnouncementController::class, 'destroyAttachment'])->name('announcements.attachments.destroy');
    // Share to WhatsApp
    Route::get('/announcements/{announcement}/share-whatsapp', [AdminAnnouncementController::class, 'shareWhatsapp'])->name('announcements.share-whatsapp');
    Route::resource('announcements', AdminAnnouncementController::class)->except(['create', 'store']);

    // Announcement Categories management
    Route::get('/announcementCategoryCreate', [\App\Http\Controllers\Admin\AnnouncementCategoryController::class, 'create'])->name('announcement-categories.create');
    Route::post('/announcementCategoryCreate', [\App\Http\Controllers\Admin\AnnouncementCategoryController::class, 'store'])->name('announcement-categories.store');
    Route::resource('announcement-categories', \App\Http\Controllers\Admin\AnnouncementCategoryController::class)->except(['create', 'store']);

    // Galleries management
    Route::get('/galleryCreate', [\App\Http\Controllers\Admin\GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/galleryCreate', [\App\Http\Controllers\Admin\GalleryController::class, 'store'])->name('galleries.store');
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class)->except(['create', 'store']);

    // Gallery Categories management
    Route::get('/galleryCategoryCreate', [\App\Http\Controllers\Admin\GalleryCategoryController::class, 'create'])->name('gallery-categories.create');
    Route::post('/galleryCategoryCreate', [\App\Http\Controllers\Admin\GalleryCategoryController::class, 'store'])->name('gallery-categories.store');
    Route::resource('gallery-categories', \App\Http\Controllers\Admin\GalleryCategoryController::class)->except(['create', 'store']);

    // Contact messages management
    Route::get('/contact', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contact.show');
    Route::patch('/contact/{contact}/mark-replied', [\App\Http\Controllers\Admin\ContactController::class, 'markAsReplied'])->name('contact.mark-replied');
    Route::delete('/contact/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('contact.destroy');

    // Pena Karsa management
    Route::get('/penaKarsaCreate', [\App\Http\Controllers\Admin\PenaKarsaController::class, 'create'])->name('pena-karsa.create');
    Route::post('/penaKarsaCreate', [\App\Http\Controllers\Admin\PenaKarsaController::class, 'store'])->name('pena-karsa.store');
    Route::resource('pena-karsa', \App\Http\Controllers\Admin\PenaKarsaController::class)->except(['create', 'store']);

    // Comments management
    Route::get('/comments', [\App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/create', [\App\Http\Controllers\Admin\CommentController::class, 'create'])->name('comments.create');
    Route::post('/comments', [\App\Http\Controllers\Admin\CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'show'])->name('comments.show');
    Route::get('/comments/{comment}/edit', [\App\Http\Controllers\Admin\CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('comments.destroy');

    // Comment actions
    Route::patch('/comments/{comment}/approve', [\App\Http\Controllers\Admin\CommentController::class, 'approve'])->name('comments.approve');
    Route::patch('/comments/{comment}/reject', [\App\Http\Controllers\Admin\CommentController::class, 'reject'])->name('comments.reject');
    Route::post('/comments/bulk-approve', [\App\Http\Controllers\Admin\CommentController::class, 'bulkApprove'])->name('comments.bulk-approve');
    Route::post('/comments/bulk-reject', [\App\Http\Controllers\Admin\CommentController::class, 'bulkReject'])->name('comments.bulk-reject');
    Route::post('/comments/bulk-delete', [\App\Http\Controllers\Admin\CommentController::class, 'bulkDelete'])->name('comments.bulk-delete');

    // Shortlinks management
    Route::get('/shortlinks', [ShortlinkController::class, 'index'])->name('shortlinks.index');
    Route::post('/shortlinks', [ShortlinkController::class, 'store'])->name('shortlinks.store');
    Route::delete('/shortlinks/{id}', [ShortlinkController::class, 'destroy'])->name('shortlinks.destroy');

    // Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'store'])->name('settings.store');

    // PPDB management
    Route::get('/ppdbCreate', [\App\Http\Controllers\Admin\PpdbController::class, 'create'])->name('ppdb.create');
    Route::post('/ppdbCreate', [\App\Http\Controllers\Admin\PpdbController::class, 'store'])->name('ppdb.store');
    Route::get('/ppdb/{ppdb}/toggle-featured', [\App\Http\Controllers\Admin\PpdbController::class, 'toggleFeatured'])->name('ppdb.toggle-featured');
    Route::get('/ppdb/{ppdb}/toggle-status', [\App\Http\Controllers\Admin\PpdbController::class, 'toggleStatus'])->name('ppdb.toggle-status');
    Route::resource('ppdb', \App\Http\Controllers\Admin\PpdbController::class)->except(['create', 'store']);

    // PPDB Documents management
    Route::get('/ppdb/{ppdb}/documents', [\App\Http\Controllers\Admin\PpdbDocumentController::class, 'index'])->name('ppdb.documents.index');
    Route::get('/ppdb/{ppdb}/documents/create', [\App\Http\Controllers\Admin\PpdbDocumentController::class, 'create'])->name('ppdb.documents.create');
    Route::post('/ppdb/{ppdb}/documents', [\App\Http\Controllers\Admin\PpdbDocumentController::class, 'store'])->name('ppdb.documents.store');
    Route::get('/ppdb/{ppdb}/documents/{document}', [\App\Http\Controllers\Admin\PpdbDocumentController::class, 'show'])->name('ppdb.documents.show');
    Route::get('/ppdb/{ppdb}/documents/{document}/edit', [\App\Http\Controllers\Admin\PpdbDocumentController::class, 'edit'])->name('ppdb.documents.edit');
    Route::put('/ppdb/{ppdb}/documents/{document}', [\App\Http\Controllers\Admin\PpdbDocumentController::class, 'update'])->name('ppdb.documents.update');
    Route::delete('/ppdb/{ppdb}/documents/{document}', [\App\Http\Controllers\Admin\PpdbDocumentController::class, 'destroy'])->name('ppdb.documents.destroy');
    Route::get('/ppdb/{ppdb}/documents/{document}/toggle-status', [\App\Http\Controllers\Admin\PpdbDocumentController::class, 'toggleStatus'])->name('ppdb.documents.toggle-status');
    Route::get('/ppdb/{ppdb}/documents/{document}/toggle-required', [\App\Http\Controllers\Admin\PpdbDocumentController::class, 'toggleRequired'])->name('ppdb.documents.toggle-required');
    Route::get('/ppdb/{ppdb}/documents/{document}/download', [\App\Http\Controllers\Admin\PpdbDocumentController::class, 'download'])->name('ppdb.documents.download');

    // PPDB FAQs management
    Route::get('/ppdb/{ppdb}/faqs', [\App\Http\Controllers\Admin\PpdbFaqController::class, 'index'])->name('ppdb.faqs.index');
    Route::get('/ppdb/{ppdb}/faqs/create', [\App\Http\Controllers\Admin\PpdbFaqController::class, 'create'])->name('ppdb.faqs.create');
    Route::post('/ppdb/{ppdb}/faqs', [\App\Http\Controllers\Admin\PpdbFaqController::class, 'store'])->name('ppdb.faqs.store');
    Route::get('/ppdb/{ppdb}/faqs/{faq}', [\App\Http\Controllers\Admin\PpdbFaqController::class, 'show'])->name('ppdb.faqs.show');
    Route::get('/ppdb/{ppdb}/faqs/{faq}/edit', [\App\Http\Controllers\Admin\PpdbFaqController::class, 'edit'])->name('ppdb.faqs.edit');
    Route::put('/ppdb/{ppdb}/faqs/{faq}', [\App\Http\Controllers\Admin\PpdbFaqController::class, 'update'])->name('ppdb.faqs.update');
    Route::delete('/ppdb/{ppdb}/faqs/{faq}', [\App\Http\Controllers\Admin\PpdbFaqController::class, 'destroy'])->name('ppdb.faqs.destroy');
    Route::get('/ppdb/{ppdb}/faqs/{faq}/toggle-status', [\App\Http\Controllers\Admin\PpdbFaqController::class, 'toggleStatus'])->name('ppdb.faqs.toggle-status');

    // PPDB Activities management
    Route::get('/ppdb/{ppdb}/activities', [\App\Http\Controllers\Admin\PpdbActivityController::class, 'index'])->name('ppdb.activities.index');
    Route::get('/ppdb/{ppdb}/activities/create', [\App\Http\Controllers\Admin\PpdbActivityController::class, 'create'])->name('ppdb.activities.create');
    Route::post('/ppdb/{ppdb}/activities', [\App\Http\Controllers\Admin\PpdbActivityController::class, 'store'])->name('ppdb.activities.store');
    Route::get('/ppdb/{ppdb}/activities/{activity}', [\App\Http\Controllers\Admin\PpdbActivityController::class, 'show'])->name('ppdb.activities.show');
    Route::get('/ppdb/{ppdb}/activities/{activity}/edit', [\App\Http\Controllers\Admin\PpdbActivityController::class, 'edit'])->name('ppdb.activities.edit');
    Route::put('/ppdb/{ppdb}/activities/{activity}', [\App\Http\Controllers\Admin\PpdbActivityController::class, 'update'])->name('ppdb.activities.update');
    Route::delete('/ppdb/{ppdb}/activities/{activity}', [\App\Http\Controllers\Admin\PpdbActivityController::class, 'destroy'])->name('ppdb.activities.destroy');
    Route::get('/ppdb/{ppdb}/activities/{activity}/toggle-status', [\App\Http\Controllers\Admin\PpdbActivityController::class, 'toggleStatus'])->name('ppdb.activities.toggle-status');
});

// Breeze authentication routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('teachers', AdminTeacherController::class);

    });

   Route::get('/guru', [FrontTeacherController::class, 'index'])
    ->name('teachers.index');

Route::get('/guru/{teacher}', [FrontTeacherController::class, 'show'])
    ->name('teachers.show');
require __DIR__.'/auth.php';
