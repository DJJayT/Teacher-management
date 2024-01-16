<?php

namespace App\Http\Controllers;

use App\Models\Teacher;

class TeacherController
{
    public function index()
    {
        $teachers = Teacher::orderBy('lastname')->paginate(15);

        return view('teacherOverview.index')
            ->with([
                'teachers' => $teachers,
            ]);
    }
}
