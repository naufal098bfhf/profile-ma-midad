<?php

namespace App\Http\Controllers;

use App\Models\InstitutionProfile;

class InstitutionProfileController extends Controller
{
    public function index()
    {
        $profile = InstitutionProfile::firstOrCreate(
            ['id' => 1],
            ['name' => 'MA Miftahul Midad']
        );

        return view('institution-profile.index', compact('profile'));
    }
}
