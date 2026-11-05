<?php

namespace App\Http\Controllers;

use App\Models\InstitutionHistory;

class InstitutionHistoryController extends Controller
{
    public function index()
    {
        $history = InstitutionHistory::find(1);

        return view('institution-history.index', compact('history'));
    }
}
