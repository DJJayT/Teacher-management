<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class SickDaysController extends Controller
{

    public function teacherSickDays($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $sickDays = Teacher::find($id)->sickDays()->get();

        return view('sickDays.SickDaysOverview')
            ->with([
                'sickDays' => $sickDays,
            ]);
    }
}
