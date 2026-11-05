<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    protected $fillable = [
        'gallery_id',
        'image',
        'thumbnail',
        'sort_order',
    ];

    protected $casts = [
        'gallery_id' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Foto dimiliki oleh satu album.
     */
    public function gallery()
    {
        return $this->belongsTo(
            Gallery::class,
            'gallery_id'
        );
    }
}
