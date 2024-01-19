<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class SickDaysController extends Controller
{

    public function teacherSickDays($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $teacher = Teacher::find($id);
        $sickDays = $teacher->sickDays()->get();

        return view('sickDays.SickDaysOverview')
            ->with([
                'teacher' => $teacher,
                'sickDays' => $sickDays,
            ]);
    }

    public function getSickDaysOfMonth($id, $month, $year): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $date = Carbon::create($year, $month);
        $teacher = Teacher::find($id);
        $sickDays = $teacher->sickDays()
            ->get();

        return view('sickDays.sickDaysList')
            ->with([
                'sickDays' => $sickDays
            ]);
    }
}
