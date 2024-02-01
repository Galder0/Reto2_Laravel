<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('set_language');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.home');

        Route::middleware(['auth'])->group(function () {
            Route::resources([
                'roles' => RoleController::class,
                'cycles' => CycleController::class,
                'departments' => DepartmentController::class,
                'modules' => ModuleController::class,
                'users' => UserController::class,
            ]);
        });
    

        Route::resource('admin/cycles', CycleController::class)->middleware(['auth']);
        Route::controller(CycleController::class)->group(function () {
            Route::get('/cycles', 'index')->name('cycles.index');
            Route::get('/cycles/{cycle}', 'show')->name('cycles.show');
        })->withoutMiddleware([Auth::class]);

        Route::resource('admin/modules', ModuleController::class)->middleware(['auth']);
        Route::controller(ModuleController::class)->group(function () {
            Route::get('/modules', 'index')->name('modules.index');
            Route::get('/modules/{modules}', 'show')->name('modules.show');
        })->withoutMiddleware([Auth::class]);

        Route::resource('admin/roles', RoleController::class)->middleware(['auth']);

        Route::controller(UserController::class)->middleware(['web', 'auth'])->group(function () {
            Route::get('/users/{user}/assign-roles', 'assignRolesForm')->name('users.assignRolesForm');
            Route::post('/users/{user}/assign-roles', 'assignRoles')->name('users.assignRoles');
            Route::delete('/users/{user}', 'destroy')->name('users.destroy');
            Route::get('/users/{user}/edit', 'edit')->name('users.edit');
            Route::put('/users/{user}', 'update')->name('users.update');
            Route::get('/users/{user}', 'show')->name('users.show');
            

            Route::get('/users/{user}/assign-cycles', 'assignCyclesForm')->name('users.assignCyclesForm');
            Route::post('/users/{user}/assign-cycles', 'assingCycles')->name('users.assignCycles');
            Route::get('/users/{user}/assign-modules', 'assignModulesForm')->name('users.assignModulesForm');
            Route::post('/users/{user}/assign-modules','assignModules')->name('users.assignModules');
            Route::get('/changePassword', 'changePasswordForm')->name('changePassword.form');
            Route::post('/changePassword', 'changePassword')->name('changePassword');
        })->withoutMiddleware([Auth::class]);

    });
	
        // Cycles
    Route::get('/cycles', [CycleController::class, 'index'])->name('cycles.index');
    Route::get('/cycles/{cycle}', [CycleController::class, 'show'])->name('cycles.show');

    // Departments
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');

    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');

    // Modules
    Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('/modules/{module}', [ModuleController::class, 'show'])->name('modules.show');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/locale/{locale}', function (string $locale) {
//     if (! in_array($locale, ['en', 'es', 'eus'])) {
//         abort(400);
//     }

//     App::setLocale($locale);

//     return redirect()->back();
// })->name('set_locale');