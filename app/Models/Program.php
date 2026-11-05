<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'category',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public const CATEGORIES = [
        'curriculum' => 'Kurikulum',
        'student_affairs' => 'Kesiswaan',
        'public_relations' => 'Hubungan Masyarakat',
        'facilities' => 'Sarana & Prasarana',
    ];
}
