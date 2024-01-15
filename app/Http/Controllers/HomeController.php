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
        if (Auth::user()->department_id != null) {
            // Obtener el departamento del usuario actual
            $department = Auth::user()->department;

            // Obtener compañeros de clase en el mismo departamento, excluyendo al propio usuario
            $classmates = User::where('department_id', $department->id)
                ->where('id', '!=', Auth::user()->id)
                ->get();

            $userCycles = Auth::user()->cycles;
            $professorModules = Auth::user()->modules;

            // Obtener los IDs de los módulos y ciclos formativos del usuario actual
            $moduleIds = $professorModules->pluck('id')->toArray();
            $cycleIds = $userCycles->pluck('id')->toArray();

            // Obtener estudiantes que están inscritos en los módulos y ciclos formativos del usuario actual
            $students = User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })->whereHas('cycles.modules', function ($query) use ($moduleIds, $cycleIds) {
                $query->whereIn('modules.id', $moduleIds)
                    ->whereIn('cycles.id', $cycleIds);
            })->get();

            // Obtener profesores que están asignados a los módulos y ciclos formativos del usuario actual
            $professors = User::whereHas('roles', function ($query) {
                $query->where('name', 'teacher');
            })->whereHas('cycles.modules', function ($query) use ($moduleIds, $cycleIds) {
                $query->whereIn('modules.id', $moduleIds)
                    ->whereIn('cycles.id', $cycleIds);
            })->get();
            
            return view('home', compact('department', 'classmates', 'professorModules', 'students', 'professors'));
        } else {
            // Obtener los ciclos formativos del usuario actual
            $userCycles = Auth::user()->cycles;
            $moduleProfessors = collect();

            // Iterar sobre los ciclos formativos del usuario
            foreach ($userCycles as $cycle) {
                // Obtener los módulos asociados al ciclo actual
                $modules = $cycle->modules;

                // Iterar sobre los módulos del ciclo actual
                foreach ($modules as $module) {
                    // Obtener profesores asociados al módulo actual que tengan el rol de 'teacher'
                    $professors = User::whereHas('roles', function ($query) {
                        $query->where('name', 'teacher');
                    })->whereHas('modules', function ($query) use ($module) {
                        $query->where('modules.id', $module->id);
                    })->get();

                    // Agregar profesores a la colección $moduleProfessors solo si no están ya presentes
                    $moduleProfessors = $moduleProfessors->merge($professors->diff($moduleProfessors));
                }
            }

            // Ordenar los ciclos formativos del usuario de más nuevo a más antiguo
            $cycles = $userCycles->sortByDesc('created_at');

            return view('home', compact('cycles', 'moduleProfessors'));
        }
    }
}
