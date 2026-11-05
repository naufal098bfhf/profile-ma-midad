<?php
namespace App\Http\Controllers;

use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where('is_active', true)
            ->orderByRaw("
                CASE category
                    WHEN 'curriculum' THEN 1
                    WHEN 'student_affairs' THEN 2
                    WHEN 'public_relations' THEN 3
                    WHEN 'facilities' THEN 4
                    ELSE 5
                END
            ")
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->groupBy('category');

        $categories = Program::CATEGORIES;

        return view(
            'programs.index',
            compact('programs', 'categories')
        );
    }
}
