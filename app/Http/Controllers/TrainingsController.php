<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Provider;
use App\Models\Teacher;
use App\Models\Training;
use App\Requests\TeacherTrainingRequest;
use App\Requests\TrainingRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TrainingsController extends Controller
{
    public function index()
    {
        return view('allTrainings.index')
            ->with([
                'trainings' => Training::paginate(1),
                'areas' => Area::all(),
                'providers' => Provider::all(),
            ]);
    }


    public function teacherTrainings(int $id)
    {
        $teacher = Teacher::findOrFail($id);
        $trainings = $teacher->trainings()
            ->orderBy('training_until')
            ->paginate(1);

        return view('teacherTrainings.index')
            ->with([
                'trainings' => $trainings,
                'teacher' => $teacher,
                'areas' => Area::all(),
                'provider' => Provider::all()
            ]);
    }

    /**
     * Edits a training with the information from the form
     * @param int $id
     * @param TrainingRequest $request
     * @return RedirectResponse
     * @throws Exception
     * @method POST
     * @route /training/{id}/edit
     */
    public function edit(int $id, TrainingRequest $request)
    {
        $training = Training::findOrFail($id);

        $training->update($request->validated());

        return redirect()->back()->with('success', __('Training successfully updated'));
    }

    /**
     * Creates a new training with the information from the form
     * @param TrainingRequest $request
     * @return RedirectResponse
     * @method POST
     * @route /training/create
     */
    public function create(TrainingRequest $request)
    {
        $training = Training::create($request->validated());

        if (!$training) {
            return redirect()->back()->with('error', __('Training could not be created'));
        }

        return redirect()->back()->with('success', __('Training successfully created'));
    }

    public function getTeacherTrainingsOverview(int $id, Request $request)
    {
        $trainings = Teacher::findOrFail($id)
            ->trainings()
            ->orderBy('training_until')
            ->paginate(1);

        return view('teacherTrainings.teacherTrainingsList')
            ->with([
                'trainings' => $trainings,
            ])->render();
    }

    public function editTeacherTraining(int $teacherId, int $trainingId, TeacherTrainingRequest $request)
    {
        $training = Teacher::findOrFail($teacherId)
            ->trainings()
            ->where('id', $trainingId)
            ->first();

        $training->update($request->validated());

        return redirect()
            ->back()
            ->with('success', __('Training successfully updated'));
    }


}
