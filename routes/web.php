<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\SickDaysController;
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
    Route::get('', [TeacherController::class, 'index'])
        ->name('home');

    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::post('/getModal/{modalId}/{additionalId?}', [ModalController::class, 'getModal'])
        ->name('getModal');

    Route::get('/allTrainings', [TrainingsController::class, 'allTrainings'])
        ->name('trainings.index');

    Route::post('/teacher/create', [TeacherController::class, 'create'])
        ->name('teacher.create');

    Route::post('/teachers/getOverview', [TeacherController::class, 'getTeachers'])
        ->name('teachers.getOverview');

    Route::post('/user/create', [AdminController::class, 'createUser'])
        ->name('user.create');

    Route::get('/allTrainings', [TrainingsController::class, 'allTrainings'])
        ->name('trainings.index');

    Route::group([
        'prefix' => 'teacher/{id}',
    ], function () {
        Route::get('/trainings', [TrainingsController::class, 'teacherTrainings'])
            ->name('teacher.trainings');

        Route::get('/trainingEntry', [TrainingsController::class, 'trainingEntry'])
            ->name('teacher.trainingEntry');

        Route::get('/sickDays', [SickDaysController::class, 'teacherSickDays'])
            ->name('teacher.sickDays');

        Route::post('/edit', [TeacherController::class, 'edit'])
            ->name('teacher.edit');
    });

    Route::group([
        'middleware' => [
            'role:admin'
        ],
        'prefix' => 'admin'
    ], function() {
        Route::get('/userManagement', [AdminController::class, 'userManagement'])
            ->name('admin.userManagement');
    });

    Route::group([
        'middleware' => [
            'role:admin'
        ],
        'prefix' => '/user/{id}'
    ], function() {
        Route::post('/edit', [AdminController::class, 'editUser'])
            ->name('user.edit');

        Route::get('/delete', [AdminController::class, 'deleteUser'])
            ->name('user.delete');
    });
});

Route::get('/sick', function () {
    return view('sickDays.SickDaysOverview');
});

Route::get('/sickdaysmonth/{id}/{month}/{year}', [SickDaysController::class, 'getSickDaysOfMonth']);
