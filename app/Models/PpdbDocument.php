<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PpdbDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'ppdb_id',
        'name',
        'description',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'is_required',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
        'file_size' => 'integer',
        'sort_order' => 'integer'
    ];

    /**
     * Get the PPDB that owns the document.
     */
    public function ppdb(): BelongsTo
    {
        return $this->belongsTo(Ppdb::class);
    }

    /**
     * Get the full URL for the document.
     */
    public function getUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    /**
     * Get the formatted file size.
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get the file extension.
     */
    public function getExtensionAttribute(): string
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

    /**
     * Get the file icon based on type.
     */
    public function getIconAttribute(): string
    {
        $extension = strtolower($this->extension);
        
        switch ($extension) {
            case 'pdf':
                return 'fas fa-file-pdf text-danger';
            case 'doc':
            case 'docx':
                return 'fas fa-file-word text-primary';
            case 'xls':
            case 'xlsx':
                return 'fas fa-file-excel text-success';
            case 'ppt':
            case 'pptx':
                return 'fas fa-file-powerpoint text-warning';
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                return 'fas fa-file-image text-info';
            case 'zip':
            case 'rar':
                return 'fas fa-file-archive text-secondary';
            default:
                return 'fas fa-file text-muted';
        }
    }

    /**
     * Scope for active documents.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for required documents.
     */
    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    /**
     * Scope for ordered documents.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}