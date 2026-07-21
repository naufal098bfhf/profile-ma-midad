<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PpdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Single-entry UX at /admin/ppdb: render edit view directly (no redirect)
        $selected = Ppdb::active()->where('is_featured', true)->first()
            ?? Ppdb::active()->latest()->first()
            ?? Ppdb::latest()->first();

        if ($selected) {
            $ppdb = $selected;
            return view('admin.ppdb.edit', compact('ppdb'));
        }

        // If no PPDB exists, show create form inline
        return view('admin.ppdb.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ppdb.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:ppdbs,slug',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'registration_start' => 'required|date',
            'registration_end' => 'required|date|after:registration_start',
            'registration_fee' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
            'requirements' => 'nullable|string',
            'test_schedule' => 'nullable|string',
            'announcement_schedule' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'status' => 'required|in:active,inactive,draft',
            'is_featured' => 'boolean',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|array',
            'facilities.*.name' => 'required_with:facilities|string|max:255',
            'facilities.*.description' => 'required_with:facilities|string',
            'facilities.*.icon' => 'required_with:facilities|string|max:50',
            'activities' => 'nullable|array',
            'activities.*.title' => 'required_with:activities|string|max:255',
            'activities.*.description' => 'required_with:activities|string',
            'activities.*.image' => 'nullable|string|max:255',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string|max:500',
            'faqs.*.answer' => 'required_with:faqs|string',
            'documents' => 'nullable|array',
            'documents.*.title' => 'required_with:documents|string|max:255',
            'documents.*.url' => 'required_with:documents|string|max:500',
            'documents.*.type' => 'required_with:documents|string|max:50',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('ppdb/hero', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('ppdb/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryImages;
        }

        // Convert boolean
        $validated['is_featured'] = $request->has('is_featured');

        Ppdb::create($validated);

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'PPDB berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ppdb $ppdb)
    {
        return view('admin.ppdb.show', compact('ppdb'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ppdb $ppdb)
    {
        return view('admin.ppdb.edit', compact('ppdb'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ppdb $ppdb)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('ppdbs', 'slug')->ignore($ppdb->id)],
            'description' => 'required|string',
            'content' => 'nullable|string',
            'registration_start' => 'required|date',
            'registration_end' => 'required|date|after:registration_start',
            'registration_fee' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
            'requirements' => 'nullable|string',
            'test_schedule' => 'nullable|string',
            'announcement_schedule' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'status' => 'required|in:active,inactive,draft',
            'is_featured' => 'boolean',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|array',
            'facilities.*.name' => 'required_with:facilities|string|max:255',
            'facilities.*.description' => 'required_with:facilities|string',
            'facilities.*.icon' => 'required_with:facilities|string|max:50',
            'activities' => 'nullable|array',
            'activities.*.title' => 'required_with:activities|string|max:255',
            'activities.*.description' => 'required_with:activities|string',
            'activities.*.image' => 'nullable|string|max:255',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string|max:500',
            'faqs.*.answer' => 'required_with:faqs|string',
            'documents' => 'nullable|array',
            'documents.*.title' => 'required_with:documents|string|max:255',
            'documents.*.url' => 'required_with:documents|string|max:500',
            'documents.*.type' => 'required_with:documents|string|max:50',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            // Delete old image
            if ($ppdb->hero_image) {
                Storage::disk('public')->delete($ppdb->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('ppdb/hero', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images
            if ($ppdb->gallery_images) {
                foreach ($ppdb->gallery_images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('ppdb/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryImages;
        }

        // Convert boolean
        $validated['is_featured'] = $request->has('is_featured');

        $ppdb->update($validated);

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'PPDB berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ppdb $ppdb)
    {
        // Delete images
        if ($ppdb->hero_image) {
            Storage::disk('public')->delete($ppdb->hero_image);
        }
        
        if ($ppdb->gallery_images) {
            foreach ($ppdb->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $ppdb->delete();

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'PPDB berhasil dihapus!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Ppdb $ppdb)
    {
        $ppdb->update(['is_featured' => !$ppdb->is_featured]);
        
        $status = $ppdb->is_featured ? 'ditampilkan' : 'disembunyikan';
        return redirect()->back()
            ->with('success', "PPDB berhasil {$status} dari halaman utama!");
    }

    /**
     * Toggle status
     */
    public function toggleStatus(Ppdb $ppdb)
    {
        $newStatus = $ppdb->status === 'active' ? 'inactive' : 'active';
        $ppdb->update(['status' => $newStatus]);
        
        $statusLabel = $newStatus === 'active' ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()
            ->with('success', "PPDB berhasil {$statusLabel}!");
    }
}

