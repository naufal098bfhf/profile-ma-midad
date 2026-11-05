<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitutionProfile extends Model
{
    protected $table = 'institution_profiles';

    protected $fillable = [
        'name',
        'nsm',
        'npsn',
        'establishment_charter',
        'operational_license',
        'founded_at',
        'address',
        'village',
        'district',
        'regency',
        'postal_code',
        'province',
        'accreditation',
        'foundation',
        'email',
        'phone',
        'website',
        'principal_name',
        'principal_period',
        'principal_photo',
        'principal_quote',
        'academic_year',
        'alumni_year',
        'vision',
        'mission',

        'class_x_male',
        'class_x_female',
        'class_xi_male',
        'class_xi_female',
        'class_xii_male',
        'class_xii_female',

        'class_x_rombel',
        'class_xi_rombel',
        'class_xii_rombel',

        'alumni_male',
        'alumni_female',

        'staff_smu',
        'staff_d3',
        'staff_s1',
        'staff_s2',
        'staff_s3',
    ];
}
