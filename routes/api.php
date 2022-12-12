<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SemesterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public routes
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);


// Protected Methods
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('auth/logout', [AuthController::class, 'logout']);
});

Route::group(['prefix' => 'program'], function(){
    Route::get('/all', [ProgramController::class, 'index']);
    Route::get('{id}/show', [ProgramController::class, 'show']);
    Route::post('/create', [ProgramController::class, 'store']);
    Route::put('{id}/update', [ProgramController::class, 'update']);
    Route::delete('{id}/destroy', [ProgramController::class, 'destroy']);
});

Route::group(['prefix' => 'semester'], function(){
    Route::get('/all', [SemesterController::class, 'index']);
    Route::get('{id}/show', [SemesterController::class, 'show']);
    Route::get('{id}/program', [SemesterController::class, 'getByIdProgram']);
    Route::post('/create', [SemesterController::class, 'store']);
    Route::put('{id}/update', [SemesterController::class, 'update']);
    Route::delete('{id}/destroy', [SemesterController::class, 'destroy']);
});

Route::group(['prefix' => 'course'], function(){
    Route::get('/all', [CourseController::class, 'index']);
    Route::get('{id}/show', [CourseController::class, 'show']);
    Route::get('{id}/semester', [CourseController::class, 'getByIdSemester']);
    Route::get('/search/{name}', [CourseController::class, 'search']);
    Route::post('/create', [CourseController::class, 'store']);
    Route::put('{id}/update', [CourseController::class, 'update']);
    Route::delete('{id}/destroy', [CourseController::class, 'destroy']);
});
