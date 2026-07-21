<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbFaq extends Model
{
    use HasFactory;

    protected $fillable = [
        'ppdb_id',
        'question',
        'answer',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Get the PPDB that owns the FAQ.
     */
    public function ppdb(): BelongsTo
    {
        return $this->belongsTo(Ppdb::class);
    }

    /**
     * Scope for active FAQs.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered FAQs.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('question');
    }

    /**
     * Get the truncated question for display.
     */
    public function getShortQuestionAttribute(): string
    {
        return \Str::limit($this->question, 60);
    }

    /**
     * Get the truncated answer for display.
     */
    public function getShortAnswerAttribute(): string
    {
        return \Str::limit(strip_tags($this->answer), 100);
    }
}