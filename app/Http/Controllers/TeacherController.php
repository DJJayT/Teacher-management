<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Requests\TeacherRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TeacherController
{
    /**
     * Shows the overview of all teachers
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @method GET
     * @route /
     */
    public function index()
    {
        $teachers = Teacher::orderBy('exit')->orderBy('lastname')->paginate(15);

        return view('teacherOverview.index')
            ->with([
                'teachers' => $teachers,
            ]);
    }

    /**
     * Edits a teacher with the information from the form
     * @param int $id
     * @param TeacherRequest $request
     * @return RedirectResponse
     * @throws Exception
     * @method POST
     * @route /teacher/{id}/edit
     */
    public function edit(int $id, TeacherRequest $request)
    {
        $teacher = Teacher::findOrFail($id);

        $abbreviationCheck = Teacher::where('abbreviation', $request->abbreviation)
            ->where('id', '!=', $id)
            ->first();

        if ($abbreviationCheck) {
            return redirect()->back()->withErrors(['abbreviation' => __('Abbreviation already exists')]);
        }

        $teacher->update($request->validated());

        return redirect()->back()->with('success', __('Teacher successfully updated'));
    }

    /**
     * Creates a new teacher with the information from the form
     * @param TeacherRequest $request
     * @return RedirectResponse
     * @method POST
     * @route /teacher/create
     */
    public function create(TeacherRequest $request)
    {
        $request->validate([
            'abbreviation' => ['unique:teachers,abbreviation'],
        ]);

        Teacher::create($request->validated());

        return redirect()->back()->with('success', __('Teacher successfully created'));
    }
}
