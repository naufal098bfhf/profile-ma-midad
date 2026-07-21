<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Halaman semua guru
     */
    public function index()
    {
        $teachers = Teacher::active()
            ->ordered()
            ->paginate(12);

        return view('front.teachers.index', compact('teachers'));
    }

    /**
     * Halaman detail guru
     */
    public function show(Teacher $teacher)
    {
        abort_if(!$teacher->is_active, 404);

        $otherTeachers = Teacher::active()
            ->where('id', '!=', $teacher->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('front.teachers.show', compact(
            'teacher',
            'otherTeachers'
        ));
    }
}
