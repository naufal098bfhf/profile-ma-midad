<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Menampilkan daftar guru.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $teachers = Teacher::when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                      ->orWhere('position', 'like', "%{$keyword}%")
                      ->orWhere('subject', 'like', "%{$keyword}%");
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.teachers.index', compact('teachers', 'keyword'));
    }

    /**
     * Form tambah guru.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Simpan guru baru.
     */
 public function store(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'education' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:30',
        'description' => 'nullable|string',
        'sort_order' => 'required|integer|min:1',
        'is_active' => 'required|boolean',
    ]);

    // Upload Foto
    $photo = null;

    if ($request->hasFile('photo')) {
        $photo = $request->file('photo')->store('teachers', 'public');
    }

    // Simpan ke Database
    Teacher::create([
        'photo' => $photo,
        'name' => $request->name,
        'position' => $request->position,
        'subject' => $request->subject,
        'education' => $request->education,
        'email' => $request->email,
        'phone' => $request->phone,
        'description' => $request->description,
        'sort_order' => $request->sort_order,
        'is_active' => $request->is_active,
    ]);

    return redirect()
        ->route('admin.teachers.index')
        ->with('success', 'Data guru berhasil ditambahkan.');
}

    /**
     * Detail guru.
     */
    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Form edit guru.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update data guru.
     */
   public function update(Request $request, Teacher $teacher)
{
    $request->validate([
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'education' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:30',
        'description' => 'nullable|string',
        'sort_order' => 'required|integer|min:1',
        'is_active' => 'required|boolean',
    ]);

    // Jika upload foto baru
    if ($request->hasFile('photo')) {

        // Hapus foto lama
        if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
            Storage::disk('public')->delete($teacher->photo);
        }

        // Upload foto baru
        $teacher->photo = $request->file('photo')->store('teachers', 'public');
    }

    // Update data
    $teacher->update([
        'photo' => $teacher->photo,
        'name' => $request->name,
        'position' => $request->position,
        'subject' => $request->subject,
        'education' => $request->education,
        'email' => $request->email,
        'phone' => $request->phone,
        'description' => $request->description,
        'sort_order' => $request->sort_order,
        'is_active' => $request->is_active,
    ]);

    return redirect()
        ->route('admin.teachers.index')
        ->with('success', 'Data guru berhasil diperbarui.');
}
    /**
     * Hapus guru.
     */
public function destroy(Teacher $teacher)
{
    try {

        // Hapus foto jika ada
        if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
            Storage::disk('public')->delete($teacher->photo);
        }

        // Hapus data guru
        $teacher->delete();

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Data guru berhasil dihapus.');

    } catch (\Exception $e) {

        return redirect()
            ->route('admin.teachers.index')
            ->with('error', 'Data guru gagal dihapus.');

    }
}
}
