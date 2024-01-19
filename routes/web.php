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
});

Route::group([
    'middleware' => 'auth',
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
        'auth',
        'role:admin'
    ],
    'prefix' => 'admin'
], function() {
    Route::get('/userManagement', [AdminController::class, 'userManagement'])
        ->name('admin.userManagement');
});

Route::post('/teacher/create', [TeacherController::class, 'create'])
    ->name('teacher.create');

Route::post('/getModal/{modalId}/{additionalId?}', [ModalController::class, 'getModal'])
    ->name('getModal');

Route::get('/sick', function () {
    return view('sickDays.SickDaysOverview');
});

Route::get('/alltrainings', [TrainingsController::class, 'allTrainings']);

Route::get('/training', [TrainingsController::class, 'training']);

Route::post('/sickdaysmonth/{id}/{month}/{year}', [SickDaysController::class, 'getSickDaysOfMonth']);
