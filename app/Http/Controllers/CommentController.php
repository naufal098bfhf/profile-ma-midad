<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\PenaKarsa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'pena_karsa_id' => 'required|exists:pena_karsa,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'comment' => 'required|string|max:1000',
        ], [
            'pena_karsa_id.required' => 'ID artikel diperlukan.',
            'pena_karsa_id.exists' => 'Artikel tidak ditemukan.',
            'name.required' => 'Nama diperlukan.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'comment.required' => 'Komentar diperlukan.',
            'comment.max' => 'Komentar maksimal 1000 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if Pena Karsa article exists and is published
        $penaKarsa = PenaKarsa::where('id', $request->pena_karsa_id)
            ->published()
            ->first();

        if (!$penaKarsa) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan atau tidak dipublikasikan.'
            ], 404);
        }

        try {
            // Check for spam content
            $spamResult = $this->detectSpam($request->comment, $request->name);
            
            $comment = Comment::create([
                'pena_karsa_id' => $request->pena_karsa_id,
                'name' => $request->name,
                'email' => $request->email,
                'comment' => $request->comment,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'is_approved' => !$spamResult['is_spam'], // Reject if spam, approve if not spam
                'is_spam' => $spamResult['is_spam'],
                'spam_reason' => $spamResult['reason'],
            ]);

            $message = $spamResult['is_spam'] 
                ? 'Komentar berhasil dikirim! Komentar akan ditampilkan setelah disetujui oleh admin karena terdeteksi sebagai spam.'
                : 'Komentar berhasil dikirim! Komentar akan ditampilkan segera.';

            return response()->json([
                'success' => true,
                'message' => $message,
                'comment' => $comment
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan komentar.'
            ], 500);
        }
    }

    /**
     * Get comments for a specific Pena Karsa article.
     */
    public function getComments(Request $request, $penaKarsaId): JsonResponse
    {
        $penaKarsa = PenaKarsa::where('id', $penaKarsaId)
            ->published()
            ->first();

        if (!$penaKarsa) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan.'
            ], 404);
        }

        $comments = $penaKarsa->approvedComments()->get();

        return response()->json([
            'success' => true,
            'comments' => $comments
        ]);
    }

    /**
     * Detect spam content in comment
     */
    private function detectSpam($comment, $name)
    {
        $spamWords = [
            // Kata-kata kotor
            'anjing', 'bangsat', 'babi', 'kontol', 'memek', 'pantat', 'bajingan', 'bego', 'goblok', 'tolol',
            'bencong', 'banci', 'lesbi', 'gay', 'homo', 'sialan', 'brengsek', 'asu', 'jancuk', 'jancok',
            'keparat', 'bajingan', 'bangsat', 'anjrit', 'anjrit', 'sial', 'sialan', 'brengsek', 'bego',
            
            // SARA (Suku, Agama, Ras, Antargolongan)
            'cina', 'chinese', 'jawa', 'sunda', 'batak', 'minang', 'bugis', 'madura', 'dayak', 'papua',
            'islam', 'muslim', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu', 'yahudi', 'nasrani',
            'kafir', 'murtad', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu', 'yahudi', 'nasrani',
            'kafir', 'murtad', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu', 'yahudi', 'nasrani',
            
            // Spam keywords
            'judi', 'togel', 'slot', 'casino', 'poker', 'domino', 'bandar', 'agen', 'situs', 'website',
            'promo', 'diskon', 'gratis', 'bonus', 'hadiah', 'undian', 'lotre', 'jackpot', 'menang',
            'kaya', 'uang', 'dollar', 'rupiah', 'juta', 'miliar', 'triliun', 'kaya', 'kaya', 'kaya',
            
            // Link patterns
            'http://', 'https://', 'www.', '.com', '.net', '.org', '.id', '.co.id', '.ac.id', '.go.id',
            'bit.ly', 'tinyurl', 'short.link', 't.co', 'goo.gl', 'youtu.be', 'facebook.com', 'instagram.com',
            'twitter.com', 'tiktok.com', 'whatsapp.com', 'telegram.me', 'line.me', 'discord.gg',
        ];

        $text = strtolower($comment . ' ' . $name);
        $reasons = [];
        
        // Check for spam words
        foreach ($spamWords as $word) {
            if (strpos($text, strtolower($word)) !== false) {
                if (in_array($word, ['anjing', 'bangsat', 'babi', 'kontol', 'memek', 'pantat', 'bajingan', 'bego', 'goblok', 'tolol', 'bencong', 'banci', 'lesbi', 'gay', 'homo', 'sialan', 'brengsek', 'asu', 'jancuk', 'jancok', 'keparat', 'anjrit', 'sial'])) {
                    $reasons[] = 'Kata-kata kotor';
                } elseif (in_array($word, ['cina', 'chinese', 'jawa', 'sunda', 'batak', 'minang', 'bugis', 'madura', 'dayak', 'papua', 'islam', 'muslim', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu', 'yahudi', 'nasrani', 'kafir', 'murtad'])) {
                    $reasons[] = 'Konten SARA';
                } elseif (in_array($word, ['judi', 'togel', 'slot', 'casino', 'poker', 'domino', 'bandar', 'agen', 'situs', 'website', 'promo', 'diskon', 'gratis', 'bonus', 'hadiah', 'undian', 'lotre', 'jackpot', 'menang', 'kaya', 'uang', 'dollar', 'rupiah', 'juta', 'miliar', 'triliun'])) {
                    $reasons[] = 'Konten spam';
                } elseif (in_array($word, ['http://', 'https://', 'www.', '.com', '.net', '.org', '.id', '.co.id', '.ac.id', '.go.id', 'bit.ly', 'tinyurl', 'short.link', 't.co', 'goo.gl', 'youtu.be', 'facebook.com', 'instagram.com', 'twitter.com', 'tiktok.com', 'whatsapp.com', 'telegram.me', 'line.me', 'discord.gg'])) {
                    $reasons[] = 'Link/URL';
                }
            }
        }

        // Check for excessive links
        $linkCount = preg_match_all('/(https?:\/\/|www\.|\.com|\.net|\.org|\.id)/i', $comment);
        if ($linkCount >= 2) {
            $reasons[] = 'Terlalu banyak link';
        }

        // Check for excessive repetition
        $words = explode(' ', $comment);
        $wordCounts = array_count_values($words);
        foreach ($wordCounts as $word => $count) {
            if (strlen($word) > 3 && $count >= 3) {
                $reasons[] = 'Pengulangan kata berlebihan';
                break;
            }
        }

        // Check for excessive caps
        $capsCount = preg_match_all('/[A-Z]/', $comment);
        $totalChars = strlen($comment);
        if ($totalChars > 10 && ($capsCount / $totalChars) > 0.7) {
            $reasons[] = 'Huruf kapital berlebihan';
        }

        // Check for excessive special characters
        $specialChars = preg_match_all('/[!@#$%^&*()_+=\[\]{}|;:,.<>?~`]/', $comment);
        if ($specialChars > 10) {
            $reasons[] = 'Karakter khusus berlebihan';
        }

        return [
            'is_spam' => !empty($reasons),
            'reason' => !empty($reasons) ? implode(', ', array_unique($reasons)) : null
        ];
    }
}
