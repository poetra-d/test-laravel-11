<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'master/student'], function() {
    Route::get('/index', [StudentController::class, 'index']);
    Route::get('/dropdown-list', [StudentController::class, 'dropdownList']);
    Route::post('/create', [StudentController::class, 'create']);
    Route::patch('/update/{id}', [StudentController::class, 'update']);
    Route::delete('/destroy/{id}', [StudentController::class, 'destroy']);
    Route::get('/{id}', [StudentController::class, 'show']);
});
