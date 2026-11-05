<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Halaman daftar album publik.
     */
    public function index()
    {
        $galleries = Gallery::with('category')
            ->withCount('photos')
            ->published()
            ->ordered()
            ->paginate(12);

        return view('galleries.index', compact('galleries'));
    }

    /**
     * Halaman detail album publik.
     */
    public function show(Gallery $gallery)
    {
        // Pastikan album sudah dipublikasikan.
        abort_unless($gallery->is_published, 404);

        // Tambahkan jumlah kunjungan album.
        $gallery->incrementViews();

        // Ambil kategori dan seluruh foto dalam album.
        $gallery->load([
            'category',
            'photos',
        ]);

        // Album sebelumnya.
        $previousGallery = Gallery::published()
            ->where('id', '<', $gallery->id)
            ->orderBy('id', 'desc')
            ->first();

        // Album berikutnya.
        $nextGallery = Gallery::published()
            ->where('id', '>', $gallery->id)
            ->orderBy('id', 'asc')
            ->first();

        // Album terkait berdasarkan kategori.
        $relatedQuery = Gallery::published()
            ->with('category')
            ->withCount('photos')
            ->where('id', '!=', $gallery->id);

        // Jika album memiliki kategori, tampilkan album
        // lain dengan kategori yang sama.
        if ($gallery->category_id !== null) {
            $relatedQuery->where(
                'category_id',
                $gallery->category_id
            );
        } else {
            $relatedQuery->whereNull('category_id');
        }

        $relatedGalleries = $relatedQuery
            ->ordered()
            ->limit(4)
            ->get();

        // Kirim seluruh variabel ke halaman detail.
        return view('galleries.show', compact(
            'gallery',
            'previousGallery',
            'nextGallery',
            'relatedGalleries'
        ));
    }
}
