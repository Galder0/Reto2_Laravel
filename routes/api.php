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

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Resource routes for departments
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('departments', DepartmentController::class)->except(['index', 'show', 'store', 'update', 'destroy']);
    Route::post('departments', [DepartmentController::class, 'store'])->withoutMiddleware(['auth:sanctum']);
    Route::put('departments/{department}', [DepartmentController::class, 'update'])->withoutMiddleware(['auth:sanctum']);
});

Route::resource('departments', DepartmentController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);
Route::delete('departments/{department}', [DepartmentController::class, 'destroy'])->withoutMiddleware(['auth:sanctum']);

// Resource routes for modules
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('modules', ModuleController::class)->except(['index', 'show', 'store', 'update', 'destroy']);
    Route::post('modules', [ModuleController::class, 'store'])->withoutMiddleware(['auth:sanctum']);
    Route::put('modules/{module}', [ModuleController::class, 'update'])->withoutMiddleware(['auth:sanctum']);
});

Route::resource('modules', ModuleController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);
Route::delete('modules/{module}', [ModuleController::class, 'destroy'])->withoutMiddleware(['auth:sanctum']);

// Repeat the above modification for other resource routes (cycles, roles, users)...

// Resource routes for cycles
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('cycles', CycleController::class)->except(['index', 'show', 'store', 'update', 'destroy']);
    Route::post('cycles', [CycleController::class, 'store'])->withoutMiddleware(['auth:sanctum']);
    Route::put('cycles/{cycle}', [CycleController::class, 'update'])->withoutMiddleware(['auth:sanctum']);
});

Route::resource('cycles', CycleController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);
Route::delete('cycles/{cycle}', [CycleController::class, 'destroy'])->withoutMiddleware(['auth:sanctum']);

// Resource routes for roles
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('roles', RoleController::class)->except(['index', 'show', 'store', 'update', 'destroy']);
    Route::post('roles', [RoleController::class, 'store'])->withoutMiddleware(['auth:sanctum']);
    Route::put('roles/{role}', [RoleController::class, 'update'])->withoutMiddleware(['auth:sanctum']);
});

Route::resource('roles', RoleController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);
Route::delete('roles/{role}', [RoleController::class, 'destroy'])->withoutMiddleware(['auth:sanctum']);

// Resource routes for users
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('users', UserController::class)->except(['index', 'show', 'store', 'update', 'destroy']);
    Route::post('users', [UserController::class, 'store'])->withoutMiddleware(['auth:sanctum']);
    Route::put('users/{user}', [UserController::class, 'update'])->withoutMiddleware(['auth:sanctum']);
});

Route::resource('users', UserController::class)->only(['index', 'show'])->withoutMiddleware(['auth:sanctum']);
Route::delete('users/{user}', [UserController::class, 'destroy'])->withoutMiddleware(['auth:sanctum']);
Route::delete('users', [UserController::class, 'store'])->withoutMiddleware(['auth:sanctum']);