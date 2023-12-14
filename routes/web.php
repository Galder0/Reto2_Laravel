<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    // Add more routes as needed
});

Route::middleware(['auth'])->group(function () {
    Route::resources([
        'roles' => RoleController::class,
]);
    
Route::controller(RoleController::class)->group(function () {
    Route::get('/roles', 'index')->name('roles.index');
    //Route::get('/incidences/{incidence}', 'show')->name('incidences.show');
})->withoutMiddleware([Auth::class]);
    

    
});