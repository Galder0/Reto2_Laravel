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
            $departments = Auth::user()->department;
    
            $classmates = User::where('department_id', Auth::user()->department_id)
                ->where('id', '!=', Auth::user()->id)
                ->get();
            
            $userCycles = Auth::user()->cycles;
            $professorModules = Auth::user()->modules;
    
            $moduleIds = $professorModules->pluck('id')->toArray();
            $cycleIds = $userCycles->pluck('id')->toArray(); // Corregido aquí
    
            $students = User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })->whereHas('cycles.modules', function ($query) use ($moduleIds, $cycleIds) {
                $query->whereIn('modules.id', $moduleIds)
                      ->whereIn('cycles.id', $cycleIds); // Asegurarse de que también estén en los ciclos correctos
            })->get();
    
            return view('home', compact('departments', 'classmates', 'professorModules', 'students'));
        } else {
            $userCycles = Auth::user()->cycles;
            
            foreach ($userCycles as $cycle) {
                $modules = $cycle->modules;
            
                // Para cada módulo, encontrar profesores con ese módulo
                foreach ($modules as $module) {
                    $moduleProfessors = User::whereHas('roles', function ($query) {
                        $query->where('name', 'professor');
                    })->whereHas('modules', function ($query) use ($module) {
                        $query->where('modules.id', $module->id);
                    })->get();
                
                    // Ahora $moduleProfessor contiene los profesores para el módulo actual
                }
            }

            // Obtener los ciclos formativos del usuario ordenados de más nuevo a más antiguo
            $cycles = $userCycles->sortByDesc('created_at');
           
            return view('home', compact('cycles', 'modules', 'moduleProfessors'));
        }
    }

}
