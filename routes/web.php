<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\AbsencesController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => 'guest',
], function () {
    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');
    Route::post('/login', [LoginController::class, 'postLogin'])
        ->name('login');
});

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/teachers', [TeacherController::class, 'index'])
        ->name('teachers.overview');

    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::post('/getModal/{modalId}/{additionalId?}', [ModalController::class, 'getModal'])
        ->name('getModal');

    Route::get('/allTrainings', [TrainingsController::class, 'index'])
        ->name('trainings.index');

    Route::post('/training/create', [TrainingsController::class, 'create'])
        ->name('training.create');

    Route::post('/training/{id}/edit', [TrainingsController::class, 'edit'])
        ->name('training.edit');

    Route::post('/teacher/create', [TeacherController::class, 'create'])
        ->name('teacher.create');

    Route::post('/teachers/getOverview', [TeacherController::class, 'getTeachers'])
        ->name('teachers.getOverview');

    Route::post('/user/create', [AdminController::class, 'createUser'])
        ->name('user.create');

    Route::group([
        'prefix' => 'teacher/{id}',
    ], function () {
        Route::get('/trainings', [TrainingsController::class, 'teacherTrainings'])
            ->name('teacher.trainings');

        Route::post('getTrainingsOverview', [TrainingsController::class, 'getTeacherTrainingsOverview'])
            ->name('teacher.getTrainingOverview');

        Route::post('/training/{trainingId}/delete', [TrainingsController::class, 'deleteTeacherTraining'])
            ->name('teacher.training.delete');

        Route::post('/training/{trainingId}/edit', [TrainingsController::class, 'editTeacherTraining'])
            ->name('teacher.training.edit');

        Route::post('/training/create', [TrainingsController::class, 'createTeacherTraining'])
            ->name('teacher.training.create');

        Route::get('/absences', [AbsencesController::class, 'teacherAbsences'])
            ->name('teacher.absences');

        Route::post('/absences/{year}/{month}', [AbsencesController::class, 'getAbsencesOfMonth'])
            ->name('teacher.absencesOfMonth');

        Route::post('/getSickDays', [AbsencesController::class, 'getSickDays'])
            ->name('teacher.getSickDays');

        Route::post('/getOffDutyDays', [AbsencesController::class, 'getOffDutyDays'])
            ->name('teacher.getOffDutyDays');

        Route::post('/edit', [TeacherController::class, 'edit'])
            ->name('teacher.edit');

        Route::post('/sickDay/create', [AbsencesController::class, 'createSickDay'])
            ->name('teacher.sickDay.create');

        Route::post('/offDutyDay/create', [AbsencesController::class, 'createOffDutyDay'])
            ->name('teacher.offDutyDay.create');

        Route::get('/offDutyDay/{offDutyDayId}/delete', [AbsencesController::class, 'deleteOffDutyDay'])
            ->name('teacher.offDutyDay.delete');

        Route::get('/sickDay/{sickDayId}/delete', [AbsencesController::class, 'deleteSickDay'])
            ->name('teacher.sickDay.delete');

        Route::post('/sickDay/{sickDayId}/edit', [AbsencesController::class, 'editSickDay'])
            ->name('teacher.sickDay.edit');

        Route::post('/offDutyDay/{offDutyDayId}/edit', [AbsencesController::class, 'editOffDutyDay'])
            ->name('teacher.offDutyDay.edit');
    });

    Route::group([
        'middleware' => [
            'role:admin'
        ],
        'prefix' => 'admin'
    ], function () {
        Route::get('/userManagement', [AdminController::class, 'userManagement'])
            ->name('admin.userManagement');
    });

    Route::group([
        'middleware' => [
            'role:admin'
        ],
        'prefix' => '/user/{id}'
    ], function () {
        Route::post('/edit', [AdminController::class, 'editUser'])
            ->name('user.edit');

        Route::get('/delete', [AdminController::class, 'deleteUser'])
            ->name('user.delete');
    });
});
