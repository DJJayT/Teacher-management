<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherOffDuty;
use App\Models\TeacherSickTime;
use App\Requests\OffDutyDayRequest;
use App\Requests\SickDayRequest;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class AbsencesController extends Controller
{

    /**
     * Shows the absences overview for a teacher
     * @param int $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     * @route /teacher/{id}/absences
     * @method GET
     */
    public function teacherAbsences(int $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $date = Carbon::now();
        $teacher = Teacher::find($id);
        $sickDays = $teacher->sickDays()
            ->where('from', '<=', $date->clone()->endOfMonth())
            ->where('until', '>=', $date->clone()->startOfMonth())
            ->paginate(15);

        $offDutyDays = $teacher->offDutyDays()
            ->where('from', '<=', $date->clone()->endOfMonth())
            ->where('until', '>=', $date->clone()->startOfMonth())
            ->paginate(15);

        return view('absences.absencesOverview')
            ->with([
                'teacher' => $teacher,
                'sickDays' => $sickDays,
                'offDutyDays' => $offDutyDays
            ]);
    }

    /**
     * Shows the absences of a teacher for a specific month
     * Used for calendar
     * @param int $id
     * @param int $year
     * @param int $month
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     * @route /teacher/{id}/absences/{year}/{month}
     * @method POST
     */
    public function getAbsencesOfMonth(
        int $id,
        int $year,
        int $month
    ): View|Application|Factory|\Illuminate\Contracts\Foundation\Application {
        $date = Carbon::create($year, $month);
        $teacher = Teacher::find($id);
        $sickDays = $teacher->sickDays()
            ->where('from', '<=', $date->clone()->endOfMonth())
            ->where('until', '>=', $date->clone()->startOfMonth())
            ->paginate(15);

        $offDutyDays = $teacher->offDutyDays()
            ->where('from', '<=', $date->clone()->endOfMonth())
            ->where('until', '>=', $date->clone()->startOfMonth())
            ->paginate(15);

        return view('absences.absencesList')
            ->with([
                'teacher' => $teacher,
                'sickDays' => $sickDays,
                'offDutyDays' => $offDutyDays
            ]);
    }

    /**
     * Returns the sick days of a teacher for a specific month
     * Used for pagination
     * @param int $id
     * @param Request $request
     * @return void
     * @throws Throwable
     * @route /teacher/{id}/getSickDays
     * @method POST
     */
    public function getSickDays(int $id, Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');

        if (isset($month, $year)) {
            $date = Carbon::create($year, $month);
        } else {
            $date = Carbon::now();
        }

        $teacher = Teacher::find($id);
        $sickDays = $teacher->sickDays()
            ->where('from', '<=', $date->clone()->endOfMonth())
            ->where('until', '>=', $date->clone()->startOfMonth())
            ->paginate(15);

        echo view('absences.sickDaysList')
            ->with([
                'sickDays' => $sickDays
            ])->render();
    }

    /**
     * Returns the off duty days of a teacher for a specific month
     * Used for pagination
     * @param int $id
     * @param Request $request
     * @return void
     * @throws Throwable
     * @route /teacher/{id}/getOffDutyDays
     * @method POST
     */
    public function getOffDutyDays(int $id, Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');

        if (isset($month, $year)) {
            $date = Carbon::create($year, $month);
        } else {
            $date = Carbon::now();
        }

        $teacher = Teacher::find($id);
        $offDutyDays = $teacher->offDutyDays()
            ->where('from', '<=', $date->clone()->endOfMonth())
            ->where('until', '>=', $date->clone()->startOfMonth())
            ->paginate(15);

        echo view('absences.offDutyList')
            ->with([
                'offDutyDays' => $offDutyDays
            ])->render();
    }

    /**
     * Creates a sick day for a teacher
     * @param int $id
     * @param SickDayRequest $request
     * @return RedirectResponse
     * @route /teacher/{id}/sickDay/create
     * @method POST
     */
    public function createSickDay(int $id, SickDayRequest $request)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return redirect()->back()->with('error', __('Teacher not found'));
        }

        $from = Carbon::create($request->get('from'));
        $until = Carbon::create($request->get('until'));

        if (isset($request->teaching_days)) {
            $teachingDays = $request->teaching_days;
        } else {
            $teachingDays = round($from->floatDiffInDays($until)) + 1;
        }

        if (isset($request->total_days)) {
            $totalDays = $request->total_days;
        } else {
            $totalDays = round($from->floatDiffInDays($until));
        }

        $teacherSickDay = TeacherSickTime::create([
            'teacher_id' => $id,
            'from' => $from,
            'until' => $until,
            'teaching_days' => $teachingDays,
            'total_days' => $totalDays,
            'reason_type_id' => $request->reason_type_id,
            'certificate' => $request->certificate,
            'certificate_from' => $request->certificate_from,
            'hospital' => $request->hospital,
        ]);

        if (!$teacherSickDay) {
            return redirect()->back()->with('error', __('Sick day could not be created'));
        }

        return redirect()->back()->with('success', __('Sick day created successfully'));
    }

    /**
     * Deletes a sick day for a teacher
     * @param int $teacherId
     * @param int $sickDayId
     * @return RedirectResponse
     * @route /teacher/{teacherId}/sickDay/{sickDayId}/delete
     * @method GET
     */
    public function deleteSickDay(int $teacherId, int $sickDayId)
    {
        $teacher = Teacher::find($teacherId);
        $sickDay = $teacher->sickDays()->find($sickDayId);

        if (!$sickDay) {
            return redirect()->back()->with('error', __('Sick day not found'));
        }

        $sickDay->delete();

        return redirect()->back()->with('success', __('Sick day successfully deleted'));
    }

    /**
     * Edits a sick day for a teacher
     * @param int $teacherId
     * @param int $sickDayId
     * @param SickDayRequest $request
     * @return RedirectResponse
     * @route /teacher/{teacherId}/sickDay/{sickDayId}/edit
     * @method POST
     */
    public function editSickDay(int $teacherId, int $sickDayId, SickDayRequest $request)
    {
        $teacher = Teacher::find($teacherId);
        $sickDay = $teacher->sickDays()->find($sickDayId);

        if (!$sickDay) {
            return redirect()->back()->with('error', __('Sick day not found'));
        }

        $from = Carbon::create($request->get('from'));
        $until = Carbon::create($request->get('until'));

        if (isset($request->teaching_days)) {
            $teachingDays = $request->teaching_days;
        } else {
            $teachingDays = round($from->floatDiffInDays($until)) + 1;
        }

        if (isset($request->total_days)) {
            $totalDays = $request->total_days;
        } else {
            $totalDays = round($from->floatDiffInDays($until)) + 1;
        }

        $sickDay->from = $from;
        $sickDay->until = $until;
        $sickDay->teaching_days = $teachingDays;
        $sickDay->total_days = $totalDays;
        $sickDay->reason_type_id = $request->reason_type_id;
        $sickDay->certificate = $request->certificate;
        $sickDay->certificate_from = $request->certificate_from;
        $sickDay->hospital = $request->hospital;

        $sickDay->save();

        return redirect()->back()->with('success', __('Sick day updated successfully'));
    }

    /**
     * Deletes an off duty day for a teacher
     * @param int $teacherId
     * @param int $offDutyDayId
     * @return RedirectResponse
     * @route /teacher/{teacherId}/offDutyDay/{offDutyDayId}/delete
     * @method GET
     */
    public function deleteOffDutyDay(int $teacherId, int $offDutyDayId)
    {
        $teacher = Teacher::find($teacherId);
        $offDutyDay = $teacher->offDutyDays()->find($offDutyDayId);

        if (!$offDutyDay) {
            return redirect()->back()->with('error', __('Off duty day not found'));
        }

        $offDutyDay->delete();

        return redirect()->back()->with('success', __('Off duty day successfully deleted'));
    }

    /**
     * Creates an off duty day for a teacher
     * @param int $id
     * @param OffDutyDayRequest $request
     * @return RedirectResponse
     * @route /teacher/{id}/offDutyDay/create
     * @method POST
     */
    public function createOffDutyDay(int $id, OffDutyDayRequest $request)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return redirect()->back()->with('error', __('Teacher not found'));
        }

        $from = Carbon::create($request->get('from'));
        $until = Carbon::create($request->get('until'));

        if (isset($request->teaching_days)) {
            $teachingDays = $request->teaching_days;
        } else {
            $teachingDays = round($from->floatDiffInDays($until)) + 1;
        }

        $offDutyDay = TeacherOffDuty::create([
            'teacher_id' => $id,
            'from' => $from,
            'until' => $until,
            'teaching_days' => $teachingDays,
            'reason_type_id' => $request->reason_type_id,
        ]);

        if (!$offDutyDay) {
            return redirect()->back()->with('error', __('Off duty day could not be created'));
        }

        return redirect()->back()->with('success', __('Off duty day created successfully'));
    }

    /**
     * Edits an off duty day for a teacher
     * @param int $teacherId
     * @param int $offDutyDayId
     * @param OffDutyDayRequest $request
     * @return RedirectResponse
     * @route /teacher/{teacherId}/offDutyDay/{offDutyDayId}/edit
     * @method POST
     */
    public function editOffDutyDay(int $teacherId, int $offDutyDayId, OffDutyDayRequest $request)
    {
        $teacher = Teacher::find($teacherId);
        $offDutyDay = $teacher->offDutyDays()->find($offDutyDayId);

        if (!$offDutyDay) {
            return redirect()->back()->with('error', __('Off duty day not found'));
        }

        $from = Carbon::create($request->get('from'));
        $until = Carbon::create($request->get('until'));

        if (isset($request->teaching_days)) {
            $teachingDays = $request->teaching_days;
        } else {
            $teachingDays = round($from->floatDiffInDays($until)) + 1;
        }

        $offDutyDay->from = $from;
        $offDutyDay->until = $until;
        $offDutyDay->teaching_days = $teachingDays;
        $offDutyDay->reason_type_id = $request->reason_type_id;

        $offDutyDay->save();

        return redirect()->back()->with('success', __('Off duty day updated successfully'));
    }
}
