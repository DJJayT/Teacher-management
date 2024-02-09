<?php

namespace App\Http\Controllers;

use App\Models\TeacherOffDuty;
use App\Models\TeacherSickTime;
use App\Models\TeacherTraining;
use App\Services\cimCalculationService;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $sickToday = TeacherSickTime::where('from', '<=', Carbon::now())
            ->where('until', '>=', Carbon::now())
            ->with('teacher')
            ->get();

        $offDutyToday = TeacherOffDuty::where('from', '<=', Carbon::now())
            ->where('until', '>=', Carbon::now())
            ->with('teacher')
            ->get();

        $trainingToday = TeacherTraining::where('from', '<=', Carbon::now())
            ->where('until', '>=', Carbon::now())
            ->with('teacher')
            ->get();

        $offToday = (new Collection())->merge($sickToday)->merge($offDutyToday)->merge($trainingToday);

        $cimCalculationService = new cimCalculationService();
        $cimNeeded = $cimCalculationService->calculateCim();

        return view('home.index')
            ->with([
                'offToday' => $offToday,
                'cimNeeded' => $cimNeeded,
            ]);
    }
}
