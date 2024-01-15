<?php

namespace App\Http\Controllers;

use App\Models\Teacher;

class TeacherController
{
    public function index()
    {
        $teachers = Teacher::paginate(25);

        return view('teacherOverview.index')
            ->with([
                'teachers' => $teachers,
            ]);
    }
}
