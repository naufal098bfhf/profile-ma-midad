<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use App\Models\PpdbDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PpdbDocumentController extends Controller
{
    /**
     * Display a listing of documents for a PPDB.
     */
    public function index(Ppdb $ppdb)
    {
        $documents = $ppdb->documents()->ordered()->get();
        
        return view('admin.ppdb.documents.index', compact('ppdb', 'documents'));
    }

    /**
     * Show the form for creating a new document.
     */
    public function create(Ppdb $ppdb)
    {
        return view('admin.ppdb.documents.create', compact('ppdb'));
    }

    /**
     * Store a newly created document.
     */
    public function store(Request $request, Ppdb $ppdb)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,zip,rar|max:10240', // 10MB max
            'is_required' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::slug($request->name) . '_' . time() . '.' . $extension;
        $filePath = $file->storeAs('ppdb/documents', $fileName, 'public');

        $document = $ppdb->documents()->create([
            'name' => $request->name,
            'description' => $request->description,
            'file_path' => $filePath,
            'file_name' => $originalName,
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'is_required' => $request->boolean('is_required'),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->to(route('admin.ppdb.index') . '#tab-docs')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }

    /**
     * Display the specified document.
     */
    public function show(Ppdb $ppdb, PpdbDocument $document)
    {
        return view('admin.ppdb.documents.show', compact('ppdb', 'document'));
    }

    /**
     * Show the form for editing the specified document.
     */
    public function edit(Ppdb $ppdb, PpdbDocument $document)
    {
        return view('admin.ppdb.documents.edit', compact('ppdb', 'document'));
    }

    /**
     * Update the specified document.
     */
    public function update(Request $request, Ppdb $ppdb, PpdbDocument $document)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,zip,rar|max:10240',
            'is_required' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'is_required' => $request->boolean('is_required'),
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?? 0
        ];

        // Handle file upload if new file is provided
        if ($request->hasFile('file')) {
            // Delete old file
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::slug($request->name) . '_' . time() . '.' . $extension;
            $filePath = $file->storeAs('ppdb/documents', $fileName, 'public');

            $data = array_merge($data, [
                'file_path' => $filePath,
                'file_name' => $originalName,
                'file_type' => $file->getMimeType(),
                'file_size' => $file->getSize()
            ]);
        }

        $document->update($data);

        return redirect()->to(route('admin.ppdb.index') . '#tab-docs')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified document.
     */
    public function destroy(Ppdb $ppdb, PpdbDocument $document)
    {
        // Delete file from storage
        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->to(route('admin.ppdb.index') . '#tab-docs')
            ->with('success', 'Dokumen berhasil dihapus.');
    }

    /**
     * Toggle active status of the document.
     */
    public function toggleStatus(Ppdb $ppdb, PpdbDocument $document)
    {
        $document->update(['is_active' => !$document->is_active]);

        $status = $document->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->to(route('admin.ppdb.index') . '#tab-docs')
            ->with('success', "Dokumen berhasil {$status}.");
    }

    /**
     * Toggle required status of the document.
     */
    public function toggleRequired(Ppdb $ppdb, PpdbDocument $document)
    {
        $document->update(['is_required' => !$document->is_required]);

        $status = $document->is_required ? 'dijadikan wajib' : 'dijadikan opsional';
        
        return redirect()->to(route('admin.ppdb.index') . '#tab-docs')
            ->with('success', "Dokumen berhasil {$status}.");
    }

    /**
     * Download the document file.
     */
    public function download(Ppdb $ppdb, PpdbDocument $document)
    {
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }
}