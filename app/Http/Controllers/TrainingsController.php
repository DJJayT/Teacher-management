<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Provider;
use App\Models\Teacher;
use App\Models\Training;

class TrainingsController extends Controller
{
    public function index()
    {
        $trainings = Training::orderBy('name')->paginate(15);

        return view('allTrainings.index')
            ->with([
                'trainings' => $trainings,
            ]);
    }

    public function teacherTrainings($id)
    {
        $teacher = Teacher::find($id);
        $trainings = $teacher->trainings()->orderBy('name')->paginate(15);

        return view('teacherTrainings.index')
            ->with([
                'trainings' => $trainings,
                'teacher' => $teacher,
                'areas' => Area::all(),
                'provider' => Provider::all()
            ]);
    }

    public function training()
    {
        return view('training.index')
            ->with([
                'areas' => Area::all(),
                'providers' => Provider::all(),
            ]);
    }

    public function allTrainings()
    {
        return view('allTrainings.index')
            ->with([
                'trainings' => training::all(),
                'areas' => Area::all(),
                'providers' => Provider::all(),
            ]);
    }

    public function trainingEntry($id)
    {
        $teacher = Teacher::find($id);
        $trainings = $teacher->trainings()->orderBy('name')->paginate(15);

        return view('trainingEntry.index')
            ->with([
                'trainings' => $trainings,
                'teacher' => $teacher,
                'areas' => Area::all(),
                'providers' => Provider::all()
            ]);
    }
}
