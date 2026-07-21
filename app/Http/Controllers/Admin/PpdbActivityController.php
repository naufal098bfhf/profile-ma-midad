<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use App\Models\PpdbActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PpdbActivityController extends Controller
{
    /**
     * Display a listing of activities for a PPDB.
     */
    public function index(Ppdb $ppdb)
    {
        $activities = $ppdb->activities()->ordered()->get();
        
        return view('admin.ppdb.activities.index', compact('ppdb', 'activities'));
    }

    /**
     * Show the form for creating a new activity.
     */
    public function create(Ppdb $ppdb)
    {
        return view('admin.ppdb.activities.create', compact('ppdb'));
    }

    /**
     * Store a newly created activity.
     */
    public function store(Request $request, Ppdb $ppdb)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            'color' => $request->color ?: '#007bff',
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($request->title) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('ppdb/activities', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $activity = $ppdb->activities()->create($data);

        return redirect()->to(route('admin.ppdb.index') . '#tab-activities')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified activity.
     */
    public function show(Ppdb $ppdb, PpdbActivity $activity)
    {
        return view('admin.ppdb.activities.show', compact('ppdb', 'activity'));
    }

    /**
     * Show the form for editing the specified activity.
     */
    public function edit(Ppdb $ppdb, PpdbActivity $activity)
    {
        return view('admin.ppdb.activities.edit', compact('ppdb', 'activity'));
    }

    /**
     * Update the specified activity.
     */
    public function update(Request $request, Ppdb $ppdb, PpdbActivity $activity)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            'color' => $request->color ?: '#007bff',
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?? 0
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($activity->image && Storage::disk('public')->exists($activity->image)) {
                Storage::disk('public')->delete($activity->image);
            }

            $image = $request->file('image');
            $imageName = Str::slug($request->title) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('ppdb/activities', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $activity->update($data);

        return redirect()->to(route('admin.ppdb.index') . '#tab-activities')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified activity.
     */
    public function destroy(Ppdb $ppdb, PpdbActivity $activity)
    {
        // Delete image if exists
        if ($activity->image && Storage::disk('public')->exists($activity->image)) {
            Storage::disk('public')->delete($activity->image);
        }

        $activity->delete();

        return redirect()->to(route('admin.ppdb.index') . '#tab-activities')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    /**
     * Toggle active status of the activity.
     */
    public function toggleStatus(Ppdb $ppdb, PpdbActivity $activity)
    {
        $activity->update(['is_active' => !$activity->is_active]);

        $status = $activity->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->to(route('admin.ppdb.index') . '#tab-activities')
            ->with('success', "Kegiatan berhasil {$status}.");
    }
}