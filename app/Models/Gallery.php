<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'thumbnail',
        'category_id',
        'is_featured',
        'is_published',
        'sort_order',
        'views',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
        'views' => 'integer',
    ];

    /**
     * Membuat slug unik berdasarkan judul.
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $baseSlug = Str::slug($value) ?: 'galeri';
        $slug = $baseSlug;
        $counter = 1;

        while (
            static::where('slug', $slug)
                ->when($this->exists, function ($query) {
                    $query->where(
                        $this->getKeyName(),
                        '!=',
                        $this->getKey()
                    );
                })
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $this->attributes['slug'] = $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Relasi kategori album.
     */
    public function category()
    {
        return $this->belongsTo(
            GalleryCategory::class,
            'category_id'
        );
    }

    /**
     * Satu album memiliki banyak foto.
     */
    public function photos()
    {
        return $this->hasMany(
            GalleryPhoto::class,
            'gallery_id'
        )->orderBy('sort_order');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        if (is_numeric($category)) {
            return $query->where('category_id', $category);
        }

        return $query->whereHas('category', function ($q) use ($category) {
            $q->where('slug', $category);
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')
            ->orderBy('created_at', 'desc');
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getCategoryLabelAttribute()
    {
        return $this->category
            ? $this->category->name
            : 'Tidak Berkategori';
    }

    public function getCategoryIconAttribute()
    {
        return $this->category
            ? $this->category->icon
            : 'fas fa-image';
    }

    public function getCategoryColorAttribute()
    {
        return $this->category
            ? $this->category->color
            : 'primary';
    }
}
