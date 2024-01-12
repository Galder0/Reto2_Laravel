<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Controllers\AdminController;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all roles from the database
        $roles = Role::all();

        // Return the response
        return response()->view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the view for creating a new role
        return response()->view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request ->validate([
            'name' => 'required|unique:roles|max:255',
            // Add any other validation rules you need
        ]);

        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        // Redirect to the roles index page or do something else
        return redirect("/admin/roles")->with('success', 'Role updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        // Return the view for displaying a specific role
        return response()->view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // Return the view for editing a specific role
        return response()->view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $role->name = $request->input('name');
    $role->updated_at = now();
    $role->save();

    // Redirect to the index page with a success message
    return redirect("/admin/roles")->with('success', 'Role updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
{
    // Check if the role name is one of the protected roles
    $protectedRoles = ['admin', 'student', 'teacher'];

    if (in_array($role->name, $protectedRoles)) {
        return redirect("/admin/roles")->with('error', 'Cannot delete protected role!');
    }

    // Delete the specified role
    $role->delete();

    // Redirect to the roles index page
    return redirect("/admin/roles")->with('success', 'Role deleted successfully!');
}
}
