<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

        return response()->json(['modules' => $modules], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|unique:modules|max:255',
            'code' => 'required|unique:modules',
            'numberhours' => 'required',
            'year' => 'required'
        ]);

        // Create a new module
        $module = Module::create($validatedData);

        return response()->json(['module' => $module, 'message' => 'Module created successfully!'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return response()->json(['module' => $module], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|integer',
            'numberhours' => 'required',
        ]);

        // Update the module with the validated data
        $module->update($validatedData);

        return response()->json(['module' => $module, 'message' => 'Module updated successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();

        return response()->json(['message' => 'Module deleted successfully!'], 200);
    }
}
