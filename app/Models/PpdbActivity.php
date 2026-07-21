<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PpdbActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'ppdb_id',
        'title',
        'description',
        'image',
        'icon',
        'color',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Get the PPDB that owns the activity.
     */
    public function ppdb(): BelongsTo
    {
        return $this->belongsTo(Ppdb::class);
    }

    /**
     * Get the full URL for the activity image.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return Storage::url($this->image);
        }
        return asset('template/assets/images/placeholder-activity.jpg');
    }

    /**
     * Get the truncated title for display.
     */
    public function getShortTitleAttribute(): string
    {
        return \Str::limit($this->title, 50);
    }

    /**
     * Get the truncated description for display.
     */
    public function getShortDescriptionAttribute(): string
    {
        return \Str::limit(strip_tags($this->description), 100);
    }

    /**
     * Get the icon class with fallback.
     */
    public function getIconClassAttribute(): string
    {
        return $this->icon ?: 'fas fa-star';
    }

    /**
     * Get the color with fallback.
     */
    public function getColorAttribute($value): string
    {
        return $value ?: '#007bff';
    }

    /**
     * Scope for active activities.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered activities.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}