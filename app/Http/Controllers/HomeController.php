<?php

namespace App\Http\Controllers;

use App\Models\TeacherOffDuty;
use App\Models\TeacherSickTime;
use App\Models\TeacherTraining;
use App\Services\cimCalculationService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Shows the home dashboard
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
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

    /**
     * Changes the dark mode of the user
     * @return RedirectResponse
     */
    public function changeDarkMode()
    {
        $user = Auth::user();
        $user->dark_mode = !$user->dark_mode;
        $user->save();

        return redirect()->back()->with('success', __('Light mode successfully changed'));
    }
}
