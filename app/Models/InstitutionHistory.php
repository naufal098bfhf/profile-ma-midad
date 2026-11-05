<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitutionHistory extends Model
{
    protected $table = 'institution_histories';

    protected $fillable = [
        'history',
        'photo_1',
        'photo_2',
    ];
}
