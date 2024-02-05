<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Requests\TeacherRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Shows the overview of all teachers
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @method GET
     * @route /}
     */
    public function index()
    {
        $teachers = Teacher::whereNull('exit')
            ->orderBy('lastname')
            ->paginate(15);

        return view('teacherOverview.index')
            ->with([
                'teachers' => $teachers,
            ]);
    }

    public function getTeachers(Request $request)
    {
        $onlyActive = $request->get('onlyActive') === 'true';

        if ($onlyActive) {
            $teachers = Teacher::whereNull('exit')
                ->orderBy('lastname')
                ->paginate(15);
        } else {
            $teachers = Teacher::orderBy('lastname')
                ->paginate(15);
        }

        return view('teacherOverview.teacherList')
            ->with([
                'teachers' => $teachers,
            ])->render();
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
