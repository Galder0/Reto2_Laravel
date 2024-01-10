<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Cycle;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $departments = Department::with('cycles')->get(); // Load cycles for each department

    // Check if the request is coming from /users*
    if (request()->is('users*')) {
        $departments->load('users'); // Load users instead of cycles
    }

    return view('departments.index', compact('departments'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments|max:255',
            // Add any other validation rules you need
        ]);

        $department = new Department();
        $department->name = $request->input('name');
        $department->save();

        return redirect()->route('departments.index')->with('success', 'Department created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Add any other validation rules you need
        ]);

        $department->name = $request->input('name');
        $department->updated_at = now();
        $department->save();

        return redirect("/admin/departments");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect("/admin/departments");
    }
}
