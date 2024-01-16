<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Training;

class TrainingsController
{
    public function index()
    {
        $trainings = Training::orderBy('name')->paginate(15);

        return view('trainingOverview.index')
            ->with([
                'trainings' => $trainings,
            ]);
    }

    public function teacherTrainings($id)
    {
        $trainings = Teacher::find($id)->trainings()->orderBy('name')->paginate(15);

        return view('teacherTrainings.index')
            ->with([
                'trainings' => $trainings,
            ]);
    }
}
