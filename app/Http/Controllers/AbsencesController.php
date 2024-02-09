<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherSickTime;
use App\Requests\SickDayRequest;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class AbsencesController extends Controller
{

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

    public function getAbsencesOfMonth(int $id, int $year, int $month): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
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

    public function getSickDays(int $id, Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');

        if(isset($month, $year)) {
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

    public function getOffDutyDays(int $id, Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');

        if(isset($month, $year)) {
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

    public function createSickDay(int $id, SickDayRequest $request)
    {
        $teacher = Teacher::find($id);
        $from = Carbon::create($request->get('from'));
        $until = Carbon::create($request->get('until'));

        if(isset($request->teaching_days)) {
            $teachingDays = $request->teaching_days;
        } else {
            $teachingDays = round($from->floatDiffInDays($until));
        }

        if(isset($request->total_days)) {
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

        if(!$teacherSickDay) {
            return redirect()->back()->with('error', __('Sick day could not be created'));
        }

        return redirect()->back()->with('success', __('Sick day created successfully'));
    }

    public function deleteSickDay(int $teacherId, int $sickDayId)
    {
        $teacher = Teacher::find($teacherId);
        $sickDay = $teacher->sickDays()->find($sickDayId);

        if(!$sickDay) {
            return redirect()->back()->with('error', __('Sick day not found'));
        }

        $sickDay->delete();

        return redirect()->back()->with('success', __('Sick day successfully deleted'));
    }

    public function editSickDay(int $teacherId, int $sickDayId, SickDayRequest $request)
    {
        $teacher = Teacher::find($teacherId);
        $sickDay = $teacher->sickDays()->find($sickDayId);

        if(!$sickDay) {
            return redirect()->back()->with('error', __('Sick day not found'));
        }

        $from = Carbon::create($request->get('from'));
        $until = Carbon::create($request->get('until'));

        if(isset($request->teaching_days)) {
            $teachingDays = $request->teaching_days;
        } else {
            $teachingDays = round($from->floatDiffInDays($until));
        }

        if(isset($request->total_days)) {
            $totalDays = $request->total_days;
        } else {
            $totalDays = round($from->floatDiffInDays($until));
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

    public function deleteOffDutyDay(int $teacherId, int $offDutyDayId)
    {
        $teacher = Teacher::find($teacherId);
        $offDutyDay = $teacher->offDutyDays()->find($offDutyDayId);

        if(!$offDutyDay) {
            return redirect()->back()->with('error', __('Off duty day not found'));
        }

        $offDutyDay->delete();

        return redirect()->back()->with('success', __('Off duty day successfully deleted'));
    }
}
