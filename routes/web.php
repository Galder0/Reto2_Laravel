<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;


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
    
    Route::middleware(['auth'])->group(function () {
        Route::resources([
            'roles' => RoleController::class,
            'cycles' => CycleController::class,
            'departments' => DepartmentController::class,
            'modules' => ModuleController::class,
        ]);
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        
        Route::controller(CycleController::class)->group(function () {
            Route::get('/cycles', 'index')->name('cycles.index');
            Route::get('/cycles/{cycle}', 'show')->name('cycles.show');
            Route::get('/cycles/create', 'create')->name('cycles.create');
            Route::post('/cycles', 'store')->name('cycles.store');
            Route::delete('/cycles/delete/{cycle}', 'delete')->name('cycles.delete');
            Route::get('/cycles/edit/{cycle}', 'edit')->name('cycles.edit');
            Route::put('/cycles/update/{cycle}', 'update')->name('cycles.update'); 
        })->withoutMiddleware([Auth::class]);

        Route::controller(ModuleController::class)->group(function () {
            Route::get('/modules', 'index')->name('modules.index');
            Route::get('/modules/{module}', 'show')->name('modules.show');
            Route::get('/modules/create', 'create')->name('modules.create');
            Route::post('/modules', 'store')->name('modules.store');
            Route::delete('/modules/delete/{module}', 'delete')->name('modules.delete');
            Route::get('/modules/edit/{module}', 'edit')->name('modules.edit');
            Route::put('/modules/update/{module}', 'update')->name('modules.update');
        })->withoutMiddleware([Auth::class]);

        Route::controller(RoleController::class)->group(function () {
            Route::get('/roles', 'index')->name('roles.index');
            Route::get('/roles/{role}', 'show')->name('roles.show');
            Route::get('/roles/create', 'create')->name('roles.create');
            Route::post('/roles', 'store')->name('roles.store');
            Route::delete('/roles/delete/{role}', 'delete')->name('roles.delete');
            Route::get('/roles/edit/{role}', 'edit')->name('roles.edit');
            Route::put('/roles/update/{role}', 'update')->name('roles.update');
        })->withoutMiddleware([Auth::class]);

        Route::controller(DepartmentController::class)->group(function () {
            Route::get('/departments', 'index')->name('departments.index');
            Route::get('/departments/{department}', 'show')->name('departments.show');
            Route::get('/departments/create', 'create')->name('departments.create');
            Route::post('/departments', 'store')->name('departments.store');
            Route::delete('/departments/delete/{department}', 'destroy')->name('departments.destroy');
            Route::get('/departments/edit/{department}', 'edit')->name('departments.edit');
            Route::put('/departments/update/{department}', 'update')->name('departments.update');
        })->withoutMiddleware([Auth::class]);

    });
});


Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    // Add more routes as needed
});

Route::middleware(['auth'])->group(function () {
    Route::resources([
    'roles' => RoleController::class,
    ]);
    Route::resources([
    'cycles' => CycleController::class,
    ]);
    Route::resources([
    'departments' => DepartmentController::class,
    ]);
    Route::resources([
    'modules' => ModuleController::class,
    ]);
    Route::resources([
    'users' => UserController::class,
    ]);
}); 

Route::controller(CycleController::class)->group(function () {
    Route::get('/cycles', 'index')->name('cycles.index');
    Route::get('/cycles/{cycle}', 'show')->name('cycles.show');
    Route::get('/cycles/create', 'create')->name('cycles.create');
    Route::post('/cycles', 'store')->name('cycles.store');
    Route::delete('/cycles/delete/{cycle}', 'delete')->name('cycles.delete');
    Route::get('/cycles/edit/{cycle}', 'edit')->name('cycles.edit');
    Route::put('/cycles/update/{cycle}', 'update')->name('cycles.update'); 
})->withoutMiddleware([Auth::class]);

Route::controller(ModuleController::class)->group(function () {
    Route::get('/modules', 'index')->name('modules.index');
    Route::get('/modules/{module}', 'show')->name('modules.show');
    Route::get('/modules/create', 'create')->name('modules.create');
    Route::post('/modules', 'store')->name('modules.store');
    Route::delete('/modules/delete/{module}', 'delete')->name('modules.delete');
    Route::get('/modules/edit/{module}', 'edit')->name('modules.edit');
    Route::put('/modules/update/{module}', 'update')->name('modules.update'); 
})->withoutMiddleware([Auth::class]);


Route::controller(RoleController::class)->group(function () {
    Route::get('/roles', 'index')->name('roles.index');
    Route::get('/roles/{role}', 'show')->name('roles.show');
    Route::get('/roles/create', 'create')->name('roles.create');
    Route::post('/roles', 'store')->name('roles.store');
    Route::delete('/roles/delete/{role}', 'delete')->name('roles.delete');
    Route::get('/roles/edit/{role}', 'edit')->name('roles.edit');
    Route::put('/roles/update/{role}', 'update')->name('roles.update'); 
})->withoutMiddleware([Auth::class]);
    
Route::controller(DepartmentController::class)->group(function () {
    Route::get('/departments', 'index')->name('departments.index');
    Route::get('/departments/{department}', 'show')->name('departments.show');
    Route::get('/departments/create', 'create')->name('departments.create');
    Route::post('/departments', 'store')->name('departments.store');
    Route::delete('/departments/delete/{department}', 'destroy')->name('departments.destroy');
    Route::get('/departments/edit/{department}', 'edit')->name('departments.edit');
    Route::put('/departments/update/{department}', 'update')->name('departments.update');
})->withoutMiddleware([Auth::class]);

Route::controller(UserController::class)->group(function () {
    Route::get('/users/{user}/assign-roles', [UserController::class, 'assignRolesForm'])->name('users.assignRolesForm');
    Route::post('/users/{user}/assign-roles', [UserController::class, 'assignRoles'])->name('users.assignRoles');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/assign-cycles', [UserController::class, 'assignCyclesForm'])->name('users.assignCyclesForm');
    Route::post('/users/{user}/assign-cycles', [UserController::class, 'assingCycles'])->name('users.assignCycles');
    
})->withoutMiddleware([Auth::class]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/set_language/{language}', LanguageController::class)->name('set_language');

