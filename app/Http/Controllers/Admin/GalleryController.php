<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Throwable;

class GalleryController extends Controller
{
    /**
     * Daftar album di halaman admin.
     */
    public function index()
    {
        $galleries = Gallery::with('category')
            ->withCount('photos')
            ->latest()
            ->paginate(12);

        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Form tambah album.
     */
    public function create()
    {
        $categories = GalleryCategory::active()
            ->ordered()
            ->get();

        return view('admin.galleries.create', compact('categories'));
    }

    /**
     * Simpan satu album dengan banyak foto.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'required|array|min:1|max:50',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:20480',
            'category_id' => 'required|exists:gallery_categories,id',
            'is_published' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $uploadedFiles = [];

        try {
            DB::transaction(function () use (
                $request,
                $validated,
                &$uploadedFiles
            ) {
                $images = $request->file('images');
                $photoData = [];

                // Simpan semua file foto terlebih dahulu.
                foreach ($images as $index => $image) {
                    $imagePath = $image->store('galleries', 'public');

                    if (!$imagePath) {
                        throw new \RuntimeException(
                            'Gagal menyimpan foto ke storage.'
                        );
                    }

                    $uploadedFiles[] = $imagePath;

                    $thumbnailPath = $this->generateThumbnail($imagePath);

                    if ($thumbnailPath) {
                        $uploadedFiles[] = $thumbnailPath;
                    }

                    $photoData[] = [
                        'image' => $imagePath,
                        'thumbnail' => $thumbnailPath ?? $imagePath,
                        'sort_order' => $index,
                    ];
                }

                // Foto pertama menjadi cover album.
                $cover = $photoData[0];

                // Buat satu record album.
                $gallery = Gallery::create([
                    'title' => $validated['title'],
                    'description' => $validated['description'] ?? null,
                    'image' => $cover['image'],
                    'thumbnail' => $cover['thumbnail'],
                    'category_id' => $validated['category_id'],
                    'is_published' => $request->boolean('is_published'),
                    'is_featured' => $request->boolean('is_featured'),
                    'sort_order' => $validated['sort_order'] ?? 0,
                    'views' => 0,
                ]);

                // Hubungkan semua foto ke satu album.
                foreach ($photoData as $photo) {
                    GalleryPhoto::create([
                        'gallery_id' => $gallery->id,
                        'image' => $photo['image'],
                        'thumbnail' => $photo['thumbnail'],
                        'sort_order' => $photo['sort_order'],
                    ]);
                }
            });

            return redirect()
                ->route('admin.galleries.index')
                ->with(
                    'success',
                    count($request->file('images')) .
                    ' foto berhasil disimpan dalam satu album.'
                );

        } catch (Throwable $e) {
            Storage::disk('public')->delete($uploadedFiles);

            Log::error('Gagal membuat album galeri: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors([
                    'images' => 'Gagal menyimpan album. Periksa kembali foto yang diunggah.',
                ]);
        }
    }

    /**
     * Detail album di halaman admin.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load(['category', 'photos']);

        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Form edit album.
     */
    public function edit(Gallery $gallery)
    {
        $categories = GalleryCategory::active()
            ->ordered()
            ->get();

        $gallery->load('photos');

        return view(
            'admin.galleries.edit',
            compact('gallery', 'categories')
        );
    }

    /**
     * Update informasi album dan menambahkan foto.
     * Foto lama tetap dipertahankan.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array|max:50',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:20480',
            'category_id' => 'required|exists:gallery_categories,id',
            'is_published' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $uploadedFiles = [];

        try {
            DB::transaction(function () use (
                $request,
                $validated,
                $gallery,
                &$uploadedFiles
            ) {
                // Perbarui informasi album.
                $gallery->update([
                    'title' => $validated['title'],
                    'description' => $validated['description'] ?? null,
                    'category_id' => $validated['category_id'],
                    'is_published' => $request->boolean('is_published'),
                    'is_featured' => $request->boolean('is_featured'),
                    'sort_order' => $validated['sort_order'] ?? 0,
                ]);

                // Jika tidak ada foto baru, berhenti di sini.
                if (!$request->hasFile('images')) {
                    return;
                }

                $nextOrder = (int) (
                    $gallery->photos()->max('sort_order') ?? -1
                ) + 1;

                foreach ($request->file('images') as $index => $image) {
                    $imagePath = $image->store('galleries', 'public');

                    if (!$imagePath) {
                        throw new \RuntimeException(
                            'Gagal menyimpan foto tambahan.'
                        );
                    }

                    $uploadedFiles[] = $imagePath;

                    $thumbnailPath = $this->generateThumbnail($imagePath);

                    if ($thumbnailPath) {
                        $uploadedFiles[] = $thumbnailPath;
                    }

                    GalleryPhoto::create([
                        'gallery_id' => $gallery->id,
                        'image' => $imagePath,
                        'thumbnail' => $thumbnailPath ?? $imagePath,
                        'sort_order' => $nextOrder + $index,
                    ]);
                }

                // Jika album sebelumnya belum memiliki cover,
                // gunakan foto pertama sebagai cover.
                if (!$gallery->image) {
                    $firstPhoto = $gallery->photos()
                        ->orderBy('sort_order')
                        ->first();

                    if ($firstPhoto) {
                        $gallery->update([
                            'image' => $firstPhoto->image,
                            'thumbnail' => $firstPhoto->thumbnail,
                        ]);
                    }
                }
            });

            $newPhotoCount = count($request->file('images') ?? []);

            $message = $newPhotoCount > 0
                ? "Album berhasil diperbarui dan {$newPhotoCount} foto baru ditambahkan."
                : 'Informasi album berhasil diperbarui.';

            return redirect()
                ->route('admin.galleries.index')
                ->with('success', $message);

        } catch (Throwable $e) {
            Storage::disk('public')->delete($uploadedFiles);

            Log::error('Gagal memperbarui album: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors([
                    'images' => 'Gagal memperbarui album. Silakan coba kembali.',
                ]);
        }
    }

    /**
     * Hapus album beserta seluruh foto.
     */
    public function destroy(Gallery $gallery)
    {
        $files = $gallery->photos()
            ->get()
            ->flatMap(function ($photo) {
                return [$photo->image, $photo->thumbnail];
            })
            ->merge([$gallery->image, $gallery->thumbnail])
            ->filter()
            ->unique()
            ->values()
            ->all();

        try {
            DB::transaction(function () use ($gallery) {
                // Foto pada gallery_photos ikut terhapus
                // karena migration menggunakan cascadeOnDelete().
                $gallery->delete();
            });

            Storage::disk('public')->delete($files);

            return redirect()
                ->route('admin.galleries.index')
                ->with('success', 'Album dan seluruh fotonya berhasil dihapus.');

        } catch (Throwable $e) {
            Log::error('Gagal menghapus album: ' . $e->getMessage());

            return back()->with(
                'error',
                'Gagal menghapus album.'
            );
        }
    }

    /**
     * Membuat thumbnail 300 x 300.
     */
    private function generateThumbnail(string $imagePath): ?string
    {
        try {
            $manager = new ImageManager(new Driver());

            $fullPath = Storage::disk('public')->path($imagePath);

            $image = $manager->read($fullPath);
            $image->cover(300, 300);

            $thumbnailPath = 'galleries/thumbnails/' . Str::uuid() . '.jpg';

            Storage::disk('public')->put(
                $thumbnailPath,
                (string) $image->toJpeg(85)
            );

            return $thumbnailPath;

        } catch (Throwable $e) {
            Log::error('Gagal membuat thumbnail: ' . $e->getMessage());

            return null;
        }
    }
}
