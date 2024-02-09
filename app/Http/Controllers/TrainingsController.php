<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Provider;
use App\Models\Teacher;
use App\Models\TeacherTraining;
use App\Models\Training;
use App\Requests\TeacherTrainingRequest;
use App\Requests\TrainingRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TrainingsController extends Controller
{
    /**
     * Returns the view with all trainings
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @method GET
     * @route /allTrainings
     */
    public function index()
    {
        return view('allTrainings.index')
            ->with([
                'trainings' => Training::paginate(1),
                'areas' => Area::all(),
                'providers' => Provider::all(),
            ]);
    }

    /**
     * Returns the view with all trainings of a teacher
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @method GET
     * @route /teacher/{id}/trainings
     */
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

    /**
     * Gets all trainings of a teacher
     * Function for pagination
     * @param int $id
     * @param Request $request
     * @return string
     * @method POST
     * @route /teacher/{id}/getTrainingsOverview
     */
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

    /**
     * Edits a training of a teacher
     * @param int $teacherId
     * @param int $trainingId
     * @param TeacherTrainingRequest $request
     * @return RedirectResponse
     * @method POST
     * @route /teacher/{teacherId}/training/{trainingId}/edit
     */
    public function editTeacherTraining(int $teacherId, int $trainingId, TeacherTrainingRequest $request)
    {
        $training = Teacher::findOrFail($teacherId)
            ->trainings()
            ->where('id', $trainingId)
            ->first();

        $request->validate([

        ]);

        $training->update([
            'training_id' => $request->training_id,
            'training_from' => $request->training_from,
            'training_until' => $request->training_until,
            'duration' => $request->duration,
        ]);

        return redirect()
            ->back()
            ->with('success', __('Training successfully updated'));
    }

    /**
     * Deletes a training of a teacher
     * @param int $teacherId
     * @param TeacherTrainingRequest $request
     * @return RedirectResponse
     * @method POST
     * @route /teacher/{teacherId}/training/create
     */
    public function createTeacherTraining(int $teacherId, TeacherTrainingRequest $request)
    {
        if ($request->duration == null) {
            $duration = round(Carbon::parse($request->training_from)
                ->startOfDay()
                ->floatDiffInDays(Carbon::parse($request->training_until)->endOfDay()));
        } else {
            $duration = $request->duration;
        }

        $teacherTraining = TeacherTraining::create([
            'teacher_id' => $teacherId,
            'training_id' => $request->training_id,
            'training_from' => $request->training_from,
            'training_until' => $request->training_until,
            'duration' => $duration,
        ]);

        if (!$teacherTraining) {
            return redirect()
                ->back()
                ->with('error', __('Training could not be created'));
        }

        return redirect()
            ->back()
            ->with('success', __('Training successfully created'));
    }


}
