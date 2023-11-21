<?php

use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\StudentGroup\StudentGroupController;
use App\Http\Controllers\Test;
use App\Http\Controllers\testController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::get('/v1/students', [StudentController::class, 'index'])->name('student.index');
Route::get('/v1/studentsValue', [StudentController::class, 'studentsValue']);
Route::get('/v1/students/{student}', [StudentController::class, 'show'])->name('student.show');
Route::delete('/v1/students/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
Route::post('/v1/students', [StudentController::class, 'store'])->name('student.store');

Route::get('/v1/events', [EventController::class, 'index']);
Route::post('/v1/participant', [EventController::class, 'participant']);
Route::get('/v1/scales', [EventController::class, 'scales']);
Route::post('/v1/events', [EventController::class, 'create']);
Route::get('/v1/levels', [EventController::class, 'levels']);
Route::get('/v1/educInst', [EventController::class, 'educInst']);
Route::get('/v1/eventType', [EventController::class, 'eventType']);
Route::get('/v1/journal', [EventController::class, 'journal']);

Route::get('/v1/test', [StudentController::class, 'test']);

Route::get('/v1/groups', [StudentGroupController::class, 'index'])->name('studentGroup.index');

Route::get('/v2/test', [testController::class, 'index'])->name('studentGroup.index');



Route::post('/v1/testValue', [Test::class, 'index'])->name('test.index');
Route::get('/v1/fuzzy', [Test::class, 'fuzzy']);
Route::post('/v1/validate', [Test::class, 'validTest']);
Route::get('/v1/response', [Test::class, 'respTest']);
