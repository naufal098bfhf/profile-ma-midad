<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'pena_karsa_id',
        'name',
        'email',
        'comment',
        'is_approved',
        'is_spam',
        'spam_reason',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_spam' => 'boolean',
    ];

    /**
     * Get the Pena Karsa article that owns the comment.
     */
    public function penaKarsa(): BelongsTo
    {
        return $this->belongsTo(PenaKarsa::class);
    }

    /**
     * Scope for approved comments
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope for pending comments
     */
    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }
}
