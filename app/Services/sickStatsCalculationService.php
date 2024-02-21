<?php

namespace App\Services;

use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;
use stdClass;

class sickStatsCalculationService
{

    /**
     * Calculates the total amount of sick days for a given year
     * @param int|null $year
     * @return stdClass
     *
     * $stats = [ (stdClass)
     *   'XY' => [ (stdClass)
     *     $stats->totalWorkers = Collection (key = GenderId, value = amount)
     *     $stats->totalCivilServants = Collection (key = GenderId, value = amount)
     *
     *     $stats->shortTimeSickWorker = Collection (key = GenderId, value = amount)
     *     $stats->shortTimeSickCivilServant = Collection (key = GenderId, value = amount)
     *
     *     $stats->middleTimeSickWorker = Collection (key = GenderId, value = amount)
     *     $stats->middleTimeSickCivilServant = Collection (key = GenderId, value = amount)
     *
     *     $stats->longTimeSickWorker = Collection (key = GenderId, value = amount)
     *     $stats->longTimeSickCivilServant = Collection (key = GenderId, value = amount)
     *   ]
     * ]
     */
    public function calculateTotalStats(Carbon $date): stdClass
    {
        $teachers = Teacher::where(function (Builder $query) use ($date) {
            $query->where('exit', '<=', $date->endOfYear())
                ->orWhereNull('exit');
        })
            ->where('entry', '<=', $date->endOfYear())
            ->with('sickDays')
            ->with('salaryGrade')
            ->with('gender')
            ->get();


        $totalSickDays = $this->calculateTotalSickDays($teachers->pluck('sickDays')->flatten(), $teachers);

        $stats = new stdClass();
        $stats->aboveA13 = $this->calculateStatsAboveA13($teachers, $totalSickDays);
        $stats->a9ToA12 = $this->calculateStatsA9ToA12($teachers, $totalSickDays);
        $stats->belowA9 = $this->calculateStatsBelowA9($teachers, $totalSickDays);
        return $stats;
    }

    /**
     * Calculates the stats for teachers with a salary grade above A13
     * @param Collection $teachers
     * @param Collection $totalSickDays
     * @return stdClass
     */
    public function calculateStatsAboveA13(Collection $teachers, Collection $totalSickDays): stdClass
    {
        $teachersToCalculate = $teachers->filter(function ($teacher) {
            return (int)substr($teacher->salaryGrade->name, 1, 2) >= 13;
        });

        $sickTeachers = $teachersToCalculate->filter(function ($teacher) {
            return $teacher->sickDays->count() > 0;
        });

        return $this->calculateStats($teachersToCalculate, $sickTeachers, $totalSickDays);
    }

    /**
     * Calculates the stats for teachers with a salary grade between A9 and A12
     * @param Collection $teachers
     * @param Collection $totalSickDays
     * @return stdClass
     */
    public function calculateStatsA9ToA12(Collection $teachers, Collection $totalSickDays): stdClass
    {
        $teachersToCalculate = $teachers->filter(function ($teacher) {
            return (int)substr($teacher->salaryGrade->name, 1, 2) >= 13;
        });

        $sickTeachers = $teachersToCalculate->filter(function ($teacher) {
            return $teacher->sickDays->count() > 0;
        });

        return $this->calculateStats($teachersToCalculate, $sickTeachers, $totalSickDays);
    }

    /**
     * Calculates the stats for teachers with a salary grade below A9
     * @param Collection $teachers
     * @param Collection $totalSickDays
     * @return stdClass
     */
    public function calculateStatsBelowA9(Collection $teachers, Collection $totalSickDays): stdClass
    {
        $teachersToCalculate = $teachers->filter(function ($teacher) {
            return (int)substr($teacher->salaryGrade->name, 1, 2) < 9;
        });

        $sickTeachers = $teachersToCalculate->filter(function ($teacher) {
            return $teacher->sickDays->count() > 0;
        });

        return $this->calculateStats($teachersToCalculate, $sickTeachers, $totalSickDays);
    }

    /**
     * Calculates the stats for a given group of teachers
     * @param Collection $teachersToCalculate
     * @param Collection $sickTeachers
     * @param Collection $totalSickDays
     * @return stdClass
     */
    private function calculateStats(
        Collection $teachersToCalculate,
        Collection $sickTeachers,
        Collection $totalSickDays
    ): stdClass {
        [$totalWorkers, $totalCivilServants] = $this->splitWorkerCivilServant($teachersToCalculate);
        $totalWorkers = $this->calculateGenderStats($totalWorkers);
        $totalCivilServants = $this->calculateGenderStats($totalCivilServants);

        [$sickWorkers, $sickCivilServant] = $this->splitWorkerCivilServant($sickTeachers);

        [
            $shortTimeSickTeachersWorker,
            $middleTimeSickTeachersWorker,
            $longTimeSickTeachersWorker
        ] = $this->calculateSickDayGroup($sickWorkers, $totalSickDays);

        [
            $shortTimeSickTeachersCivilServant,
            $middleTimeSickTeachersCivilServant,
            $longTimeSickTeachersCivilServant
        ] = $this->calculateSickDayGroup($sickCivilServant, $totalSickDays);

        //Calculate data for workers
        $shortTimeSickStatsWorker = $this->calculateGenderStats($shortTimeSickTeachersWorker);
        $middleTimeSickStatsWorker = $this->calculateGenderStats($middleTimeSickTeachersWorker);
        $longTimeSickStatsWorker = $this->calculateGenderStats($longTimeSickTeachersWorker);

        //Calculate data for civil servants
        $shortTimeSickStatsCivilServant = $this->calculateGenderStats($shortTimeSickTeachersCivilServant);
        $middleTimeSickStatsCivilServant = $this->calculateGenderStats($middleTimeSickTeachersCivilServant);
        $longTimeSickStatsCivilServant = $this->calculateGenderStats($longTimeSickTeachersCivilServant);

        $stats = new stdClass();
        $stats->totalWorkers = $totalWorkers;
        $stats->totalCivilServants = $totalCivilServants;

        $stats->shortTimeSickWorker = $shortTimeSickStatsWorker;
        $stats->shortTimeSickCivilServant = $shortTimeSickStatsCivilServant;

        $stats->middleTimeSickWorker = $middleTimeSickStatsWorker;
        $stats->middleTimeSickCivilServant = $middleTimeSickStatsCivilServant;

        $stats->longTimeSickWorker = $longTimeSickStatsWorker;
        $stats->longTimeSickCivilServant = $longTimeSickStatsCivilServant;

        return $stats;
    }

    /**
     * Sorts the sick teachers into different groups
     * @param Collection $sickTeachers
     * @param Collection $totalSickDays
     * @return array
     */
    #[ArrayShape([
        'shortTimeSickTeachers' => Collection::class,
        'middleTimeSickTeachers' => Collection::class,
        'longTimeSickTeachers' => Collection::class
    ])]
    private function calculateSickDayGroup(Collection $sickTeachers, Collection $totalSickDays): array
    {
        $shortTimeSickTeachers = $sickTeachers->filter(function ($teacher) use ($totalSickDays) {
            return $totalSickDays->get($teacher->id) <= 3;
        });

        $longTimeSickTeachers = $sickTeachers->filter(function ($teacher) use ($totalSickDays) {
            return $totalSickDays->get($teacher->id) > 42; //42 is the amount of days in 6 weeks
        });

        $middleTimeSickTeachers = $sickTeachers->filter(function ($teacher) use ($totalSickDays) {
            return $totalSickDays->get($teacher->id) > 3 && $totalSickDays->get($teacher->id) < 42; //42 is the amount of days in 6 weeks
        });

        return [$shortTimeSickTeachers, $middleTimeSickTeachers, $longTimeSickTeachers];
    }

    /**
     * Calculates the total amount of sick days for each teacher
     * @param \Illuminate\Support\Collection $sickDays
     * @param Collection $teachers
     * @return Collection
     */
    private function calculateTotalSickDays(\Illuminate\Support\Collection $sickDays, Collection &$teachers): Collection
    {
        $teacherSickDays = new Collection();
        $sickDays->each(function ($sickDay) use (&$teacherSickDays, &$teachers) {
            $dayDifference = $sickDay->from->diffInDays($sickDay->until);
            $teacherSickDays->put($sickDay->teacher->id,
                $teacherSickDays->get($sickDay->teacher->id, 0) + $dayDifference);

            if (!$teachers->contains($sickDay->teacher)) {
                $teachers->put($sickDay->teacher->id, $sickDay->teacher);
            }
        });

        return $teacherSickDays;
    }


    /**
     * Calculates the amount of teachers depending on gender
     * Also calculates the total amount of given teachers
     * @param Collection $teachers
     * @return Collection
     */
    private function calculateGenderStats(Collection $teachers): Collection
    {
        //Change id to something else, id is hard to get
        $amountPerGender = new Collection();
        $teachers->each(function ($teacher) use (&$amountPerGender) {
            $gender = $teacher->gender->id;

            if ($amountPerGender->has($gender)) {
                $amountPerGender->put($gender, $amountPerGender->get($gender) + 1);
            } else {
                $amountPerGender->put($gender, 1);
            }
        });

        $amountPerGender->put('total', $teachers->count());

        return $amountPerGender;
    }

    /**
     * Splits the teachers into workers and civil servants
     * @param Collection $sickTeachers
     * @return array
     */
    #[ArrayShape(['worker' => Collection::class, 'civilServant' => Collection::class])]
    private function splitWorkerCivilServant(Collection $sickTeachers): array
    {
        $civilServant = $sickTeachers->filter(function (Teacher $teacher) {
            return str_starts_with($teacher->salaryGrade->name, 'A');
        });

        $worker = $sickTeachers->filter(function (Teacher $teacher) {
            return !str_starts_with($teacher->salaryGrade->name, 'A');
        });

        return [$worker, $civilServant];
    }
}
