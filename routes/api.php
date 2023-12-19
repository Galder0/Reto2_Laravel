<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\ModuleController;
use App\Http\Controllers\API\CycleController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'departments' => DepartmentController::class,
]);
Route::apiResources([
    'modules' => ModuleController::class,
]);
Route::apiResources([
    'cycles' => CycleController::class,
]);
Route::apiResources([
    'roles' => RoleController::class,
]);
Route::apiResources([
    'users' => UserController::class,
]);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('departments', DepartmentController::class)->except(['index', 'show']); // Exclude 'index' and 'show' from the resource
    Route::post('departments', [DepartmentController::class, 'store']); // Add the route for creating a department
});

Route::resource('departments', DepartmentController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('modules', ModuleController::class)->except(['index', 'show']); // Exclude 'index' and 'show' from the resource
    Route::post('modules', [ModuleController::class, 'store']); // Add the route for creating a department
});

Route::resource('modules', ModuleController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('cycles', CycleController::class)->except(['index', 'show']); // Exclude 'index' and 'show' from the resource
    Route::post('cycles', [CycleController::class, 'store']); // Add the route for creating a department
});

Route::resource('cycles', CycleController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('roles', RoleController::class)->except(['index', 'show']); // Exclude 'index' and 'show' from the resource
    Route::post('roles', [RoleController::class, 'store']); // Add the route for creating a department
});

Route::resource('roles', RoleController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('users', UserController::class)->except(['index', 'show']); // Exclude 'index' and 'show' from the resource
    Route::post('users', [UserController::class, 'store']); // Add the route for creating a department
});

Route::resource('users', UserController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);