<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::all();

        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:modules|max:255',
            'code' => 'required|unique:modules',
            'numberhours' => 'required',
        ]);

        $module = new Module();
        $module->name = $request->input('name');
        $module->code = $request->input('code');
        $module->numberhours = $request->input('numberhours');
        $module->save();

        // Redirect to the modules index page or do something else
        return redirect()->route('modules.index')->with('success', 'Module created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return view('modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        return view('modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module) {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|integer',
        ]);
    
        // Check if the updated name is unique, excluding the current cycle's ID
        $isUniqueName = Model::where('name', $request->input('name'))
            ->where('id', '!=', $module->id)
            ->doesntExist();
    
        // Check if the updated code is unique, excluding the current cycle's ID
        $isUniqueCode = Model::where('code', $request->input('code'))
            ->where('id', '!=', $module->id)
            ->doesntExist();
    
        // If either the name or the code is not unique, redirect back with an error message
        if (!$isUniqueName || !$isUniqueCode) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => 'The name or code already exists. Please choose a unique value.']);
        }
    
        // Update the cycle with the validated data
        $module->name = $request->input('name');
        $module->code = $request->input('code');
        $module->numberhours = $request->input('numberhours');
        $module->updated_at = now();
        $module->save();
    
        // Redirect to the index page with a success message
        return redirect()->route('modules.index')
            ->with('success', 'Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module) {
        $module->delete();

        // Redirect to the index page with a success message
        return redirect()->route('modules.index')
            ->with('success', 'Module deleted successfully.');
    }
}
