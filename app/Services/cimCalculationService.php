<?php

namespace App\Services;

use App\Models\TeacherSickTime;
use Illuminate\Database\Eloquent\Collection;

class cimCalculationService
{

    /**
     * Calculates if a teacher needs a CIM (BEM in German) (6 weeks sick or 42 days sick in a year)
     * @return Collection
     */
    public function calculateCim(): Collection
    {
        $startOfYear = now()->startOfYear();
        $endOfYear = now()->endOfYear();

        $sickDays = TeacherSickTime::where('until', '>=', $startOfYear)
            ->where('from', '<=', $endOfYear)
            ->with('teacher')
            ->get();

        $cimTeachersSixWeeks = $this->calculateCimSixWeeks($sickDays);
        $cimTeachersTotalDays = $this->calculateCimTotalDays($sickDays);

        return (new Collection())->merge($cimTeachersSixWeeks)->merge($cimTeachersTotalDays);
    }

    /**
     * Calculates if a teacher needs a CIM (BEM in German) - 6 weeks sick
     * @param Collection $sickDays
     * @return Collection
     */
    private function calculateCimSixWeeks(Collection $sickDays): Collection
    {
        $cimTeachers = new Collection();

        $sickDays->each(function ($sickDay) use (&$cimTeachers) {
            if($sickDay->from->diffInWeeks($sickDay->until) >= 6) {
                if(!$cimTeachers->contains($sickDay->teacher)) {
                    $cimTeachers->push($sickDay->teacher);
                }
            }
        });

        return $cimTeachers;
    }

    /**
     * Calculates if a teacher needs a CIM (BEM in German) - 42 days sick in a year
     * @param Collection $sickDays
     * @return Collection
     */
    public function calculateCimTotalDays(Collection $sickDays): Collection
    {
        $teacherSickDays = new Collection();
        $teachers = new Collection();

        $sickDays->each(function ($sickDay) use (&$teacherSickDays, &$teachers) {
            $dayDifference = $sickDay->from->diffInDays($sickDay->until);
            $teacherSickDays->put($sickDay->teacher->id, $teacherSickDays->get($sickDay->teacher->id, 0) + $dayDifference);

            if(!$teachers->contains($sickDay->teacher)) {
                $teachers->put($sickDay->teacher->id, $sickDay->teacher);
            }
        });

        $teacherSickDays = $teacherSickDays->filter(function ($sickDays) {
            return $sickDays >= 42;
        });

        $cimTeachers = new Collection();

        $teacherSickDays->each(function ($sickDay, int $key) use(&$cimTeachers, $teachers) {
            $cimTeachers->push($teachers->get($key));
        });

        return $cimTeachers;
    }
}
