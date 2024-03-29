<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cycle;
use App\Models\Module;
use App\Models\Department;
use Illuminate\Support\Facades\DB;


class CycleController extends Controller
{

    public function assignModulesForm(Cycle $cycle)
    {
        $modules = Module::all();
        $cyclesModules = $cycle->modules;

        return view('cycles.assignModules', compact('cycle', 'modules', 'cyclesModules'));
    }

    public function assignModules(Request $request, Cycle $cycle)
    {
        $request->validate([
            'modules' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $cycle) {
            // Sync modules for the cycle
            $cycle->modules()->sync($request->input('modules'));
        });

        return redirect('/cycles')->with('success', 'Modules assigned successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all cycles from the database
        $cycles = Cycle::all();
        
        // Return the response
        return response()->view('cycles.index', compact('cycles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return response()->view('cycles.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:cycles',
            'code' => 'required|digits:4|unique:cycles',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Check uniqueness separately for 'name'
        if (Cycle::where('name', $validatedData['name'])->exists()) {
            return redirect()->route('cycles.create')->with('error', 'Cycle name must be unique.')->withInput();
        }

        // Check uniqueness separately for 'code'
        if (Cycle::where('code', $validatedData['code'])->exists()) {
            return redirect()->route('cycles.create')->with('error', 'Cycle code must be unique.')->withInput();
        }

        // Add the 'department_id' to the validated data
        $validatedData['department_id'] = $request->input('department_id');

        // Create a new Cycle instance and save
        $cycle = new Cycle($validatedData);
        $cycle->save();

        // Redirect to the cycles index page
        return redirect("/admin/cycles");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\View\View
     */
    public function show(Cycle $cycle) {
        
        $usersInCycle = $cycle->users;
        $modules = Module::all();
        $cycleModules = $cycle->modules;

        return view('cycles.show', compact('cycle', 'modules', 'cycleModules', 'usersInCycle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\View\View
     */
    public function edit(Cycle $cycle) {

        $modules = Module::all();
        $departments = Department::all();
        $cycleModules = $cycle->modules;

        return view('cycles.edit', compact('cycle', 'modules', 'cycleModules', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cycle $cycle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:4|unique:cycles,code,' . $cycle->id,
            'modules' => 'array', // Assuming modules is an array
        ]);

        DB::transaction(function () use ($request, $cycle) {
            $cycle->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
            ]);

            // Sync modules for the cycle
            $cycle->modules()->sync($request->input('modules'));
        });

        return redirect("/admin/cycles");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cycle $cycle) {
        DB::transaction(function () use ($cycle) {
            // Detach modules before deleting the cycle
            $cycle->modules()->detach();
            // Delete the cycle
            $cycle->delete();
        });

        // Redirect to the index page with a success message
        return redirect("/admin/cycles");
    }
}
