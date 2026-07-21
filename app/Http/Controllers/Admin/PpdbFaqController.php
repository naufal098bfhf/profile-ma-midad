<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use App\Models\PpdbFaq;
use Illuminate\Http\Request;

class PpdbFaqController extends Controller
{
    /**
     * Display a listing of FAQs for a PPDB.
     */
    public function index(Ppdb $ppdb)
    {
        $faqs = $ppdb->faqs()->ordered()->get();
        
        return view('admin.ppdb.faqs.index', compact('ppdb', 'faqs'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create(Ppdb $ppdb)
    {
        return view('admin.ppdb.faqs.create', compact('ppdb'));
    }

    /**
     * Store a newly created FAQ.
     */
    public function store(Request $request, Ppdb $ppdb)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string|max:2000',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $faq = $ppdb->faqs()->create([
            'question' => $request->question,
            'answer' => $request->answer,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->to(route('admin.ppdb.index') . '#tab-faq')
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

    /**
     * Display the specified FAQ.
     */
    public function show(Ppdb $ppdb, PpdbFaq $faq)
    {
        return view('admin.ppdb.faqs.show', compact('ppdb', 'faq'));
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit(Ppdb $ppdb, PpdbFaq $faq)
    {
        return view('admin.ppdb.faqs.edit', compact('ppdb', 'faq'));
    }

    /**
     * Update the specified FAQ.
     */
    public function update(Request $request, Ppdb $ppdb, PpdbFaq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string|max:2000',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->to(route('admin.ppdb.index') . '#tab-faq')
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Remove the specified FAQ.
     */
    public function destroy(Ppdb $ppdb, PpdbFaq $faq)
    {
        $faq->delete();

        return redirect()->to(route('admin.ppdb.index') . '#tab-faq')
            ->with('success', 'FAQ berhasil dihapus.');
    }

    /**
     * Toggle active status of the FAQ.
     */
    public function toggleStatus(Ppdb $ppdb, PpdbFaq $faq)
    {
        $faq->update(['is_active' => !$faq->is_active]);

        $status = $faq->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->to(route('admin.ppdb.index') . '#tab-faq')
            ->with('success', "FAQ berhasil {$status}.");
    }
}