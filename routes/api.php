<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\ModuleController;
use App\Http\Controllers\API\CycleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'department' => DepartmentController::class,
]);
Route::apiResources([
    'module' => ModuleController::class,
]);
Route::apiResources([
    'cycle' => CycleController::class,
]);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('department', DepartmentController::class)->except(['index', 'show']); // Exclude 'index' and 'show' from the resource
    Route::post('department', [DepartmentController::class, 'store']); // Add the route for creating a department
});

Route::resource('department', DepartmentController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('module', ModuleController::class)->except(['index', 'show']); // Exclude 'index' and 'show' from the resource
    Route::post('module', [ModuleController::class, 'store']); // Add the route for creating a department
});

Route::resource('module', ModuleController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('cycle', CycleController::class)->except(['index', 'show']); // Exclude 'index' and 'show' from the resource
    Route::post('cycle', [CycleController::class, 'store']); // Add the route for creating a department
});

Route::resource('cycle', CycleController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);