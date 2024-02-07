<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Provider;
use App\Models\Teacher;
use App\Models\Training;
use App\Requests\TrainingRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    /**
     * Returns the training list for the training overview
     * @param Request $request
     * @return string
    */
    public function getTrainings(Request $request)
    {

        return view('allTrainings.trainingList')
            ->with([
                'trainings' => $trainings,
            ])->render();
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
        $training = Teacher::findOrFail($id);

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
        Training::create($request->validated());

        return redirect()->back()->with('success', __('Training successfully created'));
    }


}
