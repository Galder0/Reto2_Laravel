<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Cycle;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $departments = Auth::user()->department->id;
        $classmates = User::where('department_id', Auth::user()->department_id)
            ->where('id', '!=', Auth::user()->id)
            ->get();
        $userCycles = Auth::user()->cycles;
        $professorModules = collect();

        // Recorrer los ciclos y obtener los módulos asociados a cada ciclo
        foreach ($userCycles as $cycle) {
            // Obtener los módulos a través de la relación en la tabla pivote cycles_modules
            $modules = $cycle->modules;

            // Agregar los módulos a la colección general
            $professorModules = $professorModules->merge($modules);
        }

        // Obtener los IDs de los módulos
        $moduleIds = $professorModules->pluck('id')->toArray();

        // Obtener los IDs de los ciclos
        $cycleIds = $userCycles->pluck('id')->toArray();

        // Obtener los usuarios que son estudiantes y están asociados a los módulos y ciclos
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->whereHas('cycles.modules', function ($query) use ($moduleIds) {
            // Filtrar por IDs de módulos
            $query->whereIn('modules.id', $moduleIds);
        })->whereHas('cycles', function ($query) use ($cycleIds) {
            // Filtrar por IDs de ciclos
            $query->whereIn('cycles.id', $cycleIds);
        })->get();

        return view('home', compact('departments', 'classmates', 'professorModules', 'students'));
    }

}
