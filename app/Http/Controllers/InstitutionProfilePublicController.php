<?php

namespace App\Http\Controllers;

use App\Models\InstitutionProfile;

class InstitutionProfilePublicController extends Controller
{
    public function show()
    {
        $profile = InstitutionProfile::firstOrCreate(
            ['id' => 1],
            ['name' => 'MA Miftahul Midad']
        );

        return view('institution-profile.index', compact('profile'));
    }
}
