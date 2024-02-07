<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
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
}
