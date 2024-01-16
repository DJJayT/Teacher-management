<?php

use App\Http\Controllers\LoginController;
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

    Route::get('/sickDays', [SickDaysController::class, 'teacherSickDays'])
        ->name('teacher.sickDays');
});

Route::get('/test', function () {
    return view('sickDays.SickDaysOverview');
});

Route::get('/testchr', function () {
    return view('trainingEntry.index');
});

