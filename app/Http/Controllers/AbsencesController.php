<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AbsencesController extends Controller
{

    public function teacherAbsences($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
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

    public function getAbsencesOfMonth($id, $year, $month): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $date = Carbon::create($year, $month);
        $teacher = Teacher::find($id);
        $sickDays = $teacher->sickDays()
            ->where('from', '<=', $date->clone()->endOfMonth())
            ->where('until', '>=', $date->clone()->startOfMonth())
            ->paginate(15);

        return view('absences.sickDaysList')
            ->with([
                'sickDays' => $sickDays
            ]);
    }
}
