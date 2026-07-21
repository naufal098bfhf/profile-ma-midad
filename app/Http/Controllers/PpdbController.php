<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppdb;
use App\Models\PpdbDocument;
use Illuminate\Support\Facades\Storage;

class PpdbController extends Controller
{
    /**
     * Display the PPDB page.
     */
    public function index()
    {
        // Get active and featured PPDB
        $ppdb = Ppdb::active()->featured()->first();
        
        // If no featured PPDB, get the latest active one
        if (!$ppdb) {
            $ppdb = Ppdb::active()->latest()->first();
        }
        
        // If no active PPDB, get the latest one (even if inactive)
        if (!$ppdb) {
            $ppdb = Ppdb::latest()->first();
        }
        
        // If no PPDB exists, return 404 or show default content
        if (!$ppdb) {
            abort(404, 'PPDB tidak ditemukan');
        }

        // Extract data from PPDB model
        $faqs = $ppdb->faqs ?? [];
        $facilities = $ppdb->facilities ?? [];
        $activities = $ppdb->activities ?? [];
        $documents = $ppdb->documents ?? [];
        
        // Get active documents for download
        $downloadDocuments = $ppdb->activeDocuments;
        
        // Get active FAQs from database
        $activeFaqs = $ppdb->activeFaqs;
        
        // Get active activities from database
        $activeActivities = $ppdb->activeActivities;

        return view('ppdb.index', compact('ppdb', 'faqs', 'facilities', 'activities', 'documents', 'downloadDocuments', 'activeFaqs', 'activeActivities'));
    }

    /**
     * Download a PPDB document.
     */
    public function downloadDocument(Ppdb $ppdb, PpdbDocument $document)
    {
        // Check if document belongs to this PPDB
        if ($document->ppdb_id !== $ppdb->id) {
            abort(404, 'Dokumen tidak ditemukan.');
        }

        // Check if document is active
        if (!$document->is_active) {
            abort(404, 'Dokumen tidak tersedia.');
        }

        // Check if file exists
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }
}
