<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\PenaKarsa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of comments.
     */
    public function index(Request $request)
    {
        $query = Comment::with('penaKarsa');

        // Filter by approval status
        if ($request->filled('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'rejected') {
                $query->where('is_approved', false);
            }
        }

        // Search by name, email, or comment content
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%");
            });
        }

        $comments = $query->latest()->paginate(20)->withQueryString();

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new comment.
     */
    public function create()
    {
        $penaKarsaArticles = PenaKarsa::published()->get();
        return view('admin.comments.create', compact('penaKarsaArticles'));
    }

    /**
     * Store a newly created comment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pena_karsa_id' => 'required|exists:pena_karsa,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'comment' => 'required|string|max:1000',
            'is_approved' => 'boolean'
        ]);

        Comment::create([
            'pena_karsa_id' => $request->pena_karsa_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'is_approved' => $request->has('is_approved'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Komentar berhasil ditambahkan.');
    }

    /**
     * Display the specified comment.
     */
    public function show(Comment $comment)
    {
        $comment->load('penaKarsa');
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified comment.
     */
    public function edit(Comment $comment)
    {
        $penaKarsaArticles = PenaKarsa::published()->get();
        return view('admin.comments.edit', compact('comment', 'penaKarsaArticles'));
    }

    /**
     * Update the specified comment.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'pena_karsa_id' => 'required|exists:pena_karsa,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'comment' => 'required|string|max:1000',
            'is_approved' => 'boolean'
        ]);

        $comment->update([
            'pena_karsa_id' => $request->pena_karsa_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'is_approved' => $request->has('is_approved'),
        ]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Komentar berhasil diperbarui.');
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')
            ->with('success', 'Komentar berhasil dihapus.');
    }

    /**
     * Approve the specified comment.
     */
    public function approve(Comment $comment): JsonResponse
    {
        $comment->update(['is_approved' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil disetujui.'
        ]);
    }

    /**
     * Reject the specified comment.
     */
    public function reject(Comment $comment): JsonResponse
    {
        $comment->update(['is_approved' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil ditolak.'
        ]);
    }

    /**
     * Bulk approve comments.
     */
    public function bulkApprove(Request $request): JsonResponse
    {
        $request->validate([
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:comments,id'
        ]);

        Comment::whereIn('id', $request->comment_ids)
            ->update(['is_approved' => true]);

        return response()->json([
            'success' => true,
            'message' => count($request->comment_ids) . ' komentar berhasil disetujui.'
        ]);
    }

    /**
     * Bulk reject comments.
     */
    public function bulkReject(Request $request): JsonResponse
    {
        $request->validate([
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:comments,id'
        ]);

        Comment::whereIn('id', $request->comment_ids)
            ->update(['is_approved' => false]);

        return response()->json([
            'success' => true,
            'message' => count($request->comment_ids) . ' komentar berhasil ditolak.'
        ]);
    }

    /**
     * Bulk delete comments.
     */
    public function bulkDelete(Request $request): JsonResponse
    {
        $request->validate([
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:comments,id'
        ]);

        Comment::whereIn('id', $request->comment_ids)->delete();

        return response()->json([
            'success' => true,
            'message' => count($request->comment_ids) . ' komentar berhasil dihapus.'
        ]);
    }
}
