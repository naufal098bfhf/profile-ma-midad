<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable = [
        'photo',
        'name',
        'position',
        'subject',
        'education',
        'email',
        'phone',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = [
        'photo_url',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    public function getPhotoUrlAttribute(): string
    {
        if (
            $this->photo &&
            Storage::disk('public')->exists($this->photo)
        ) {
            return asset('storage/' . $this->photo);
        }

        return asset('images/default-teacher.png');
    }

    protected static function booted()
    {
        static::deleting(function ($teacher) {

            if (
                $teacher->photo &&
                Storage::disk('public')->exists($teacher->photo)
            ) {
                Storage::disk('public')->delete($teacher->photo);
            }

        });
    }
}
