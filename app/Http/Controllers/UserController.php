<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Add this line
use App\Models\Role;
use App\Models\Cycle;
use App\Models\Module;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
{
    $query = User::query();

    // Check if there is a search query
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', "%$search%");
    }

    $query->orderBy('surnames');
    
    $users = $query->paginate(20);

    return view('users.index', compact('users'));
}
    
    public function assignRolesForm(User $user)
    {
        $roles = Role::all();
        $usersRoles = $user->roles;

        return view('users.assignRoles', compact('user', 'roles', 'usersRoles'));
    }

    public function assignRoles(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required|array',
        ]);

        // Check if the user has the role "student"
        if ($user->hasRole('student')) {
            return redirect()->back()->with('error', 'Students cannot be assigned additional roles.');
        }

        DB::transaction(function () use ($request, $user) {
            // Sync roles for the user
            $user->roles()->sync($request->input('roles'));
        });

        return redirect('/admin')->with('success', 'Roles assigned successfully.');
    }
    public function assignCyclesForm(User $user)
    {
        $cycles = Cycle::all();
        $userCycles = $user->cycles;
    
        return view('users.assignCycles', compact('user', 'cycles', 'userCycles'));
    }

    

    public function assingCycles(Request $request, User $user)
    {
        // Validate the form data
        $request->validate([
            'cycles' => 'array', // Allow null or array
        ]);

        DB::transaction(function () use ($request, $user) {
            // Get selected cycles from the form
            $cycles = $request->input('cycles');

            // Remove existing data if no cycles are selected
            if ($cycles === null) {
                $user->modules()->detach();
            } else {
                // Loop through each selected cycle
                foreach ($cycles as $cycle) {
                    // Get all module IDs associated with the selected cycle
                    $moduleIds = DB::table('cycles_modules')
                        ->where('cycle_id', $cycle)
                        ->pluck('module_id');

                    // Sync user with modules and set the cycle_id pivot value
                    $syncData = [];
                    foreach ($moduleIds as $moduleId) {
                        $syncData[$moduleId] = [
                            'cycle_id' => $cycle,
                            'created_at' => now(),
                        ];
                        
                    }

                    $user->modules()->sync($syncData);
                }
            }
        });
    
        return redirect('/admin')->with('success', 'Cycles and Modules assigned successfully.');
    }

    public function assignModulesForm(User $user)
{
    //TODOO Delete modules does not work fully
    $modules = Module::all();
    $userModules = $user->modules;

    return view('users.assignModules', compact('user', 'modules', 'userModules'));
}

public function assignModules(Request $request, User $user)
{
    $request->validate([
        'modules' => 'required|array',
    ]);

    DB::transaction(function () use ($request, $user) {
        // Sync modules for the user
        $user->modules()->sync($request->input('modules'));
    });

    return redirect('/admin')->with('success', 'Modules assigned successfully.');
}

    

    public function destroy(User $user)
    {
        DB::transaction(function () use ($user) {
            // Detach roles before deleting the user
            $user->roles()->detach();

            // Delete the user
            $user->delete();
        });

        return redirect('/admin')->with('success', 'User deleted successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $cycles = Cycle::all();
        $userRoles = $user->roles;
        $userCycles = $user->cycles;
        $departments = Department::all();

        return view('users.edit', compact('user', 'roles', 'cycles', 'userRoles', 'userCycles', 'departments'));
    }
    public function update(Request $request, User $user)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'roles' => 'required|array',
        'department' => 'nullable|exists:departments,id',
        'cycles' => 'array',
        'modules' => 'array', // Add validation for modules
    ]);

    DB::transaction(function () use ($request, $user) {
        // Update user details
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        // Sync roles for the user
        $user->roles()->sync($request->input('roles'));

        // Sync cycles for the user
        $user->cycles()->sync($request->input('cycles', []));

        // Sync modules for the user
        $user->modules()->sync($request->input('modules', []));

        // Associate the selected department with the user if provided
        $user->department()->associate($request->input('department'));
        $user->save();
    });

    return redirect('/admin')->with('success', 'User updated successfully.');
}
    
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
{
    $departments = Department::all();
    $roles = Role::all();
    $cycles = Cycle::all();
    $modules = Module::all(); // Fetch all modules

    return view('users.create', compact('roles', 'cycles', 'departments', 'modules'));
}
// public function store(Request $request)
// {
//     // Validate the request data
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:users,email|max:255',
//         'roles' => 'required|array',
//         'department' => 'nullable|exists:departments,id',
//         'cycles' => 'array',
//         'modules' => 'array', // Add validation for modules
//     ]);

//     DB::transaction(function () use ($request) {
//         // Create a new user with a default password '12341234'
//         $user = new User([
//             'name' => $request->input('name'),
//             'email' => $request->input('email'),
//             'password' => Hash::make('12341234'),
//         ]);

//         $user->save();

//         // Sync roles for the user
//         $user->roles()->sync($request->input('roles'));

//         // Sync cycles for the user
//         $user->cycles()->sync($request->input('cycles', []));

//         // Sync modules for the user
//         $user->modules()->sync($request->input('modules', []));

//         // Associate the selected department with the user if provided
//         $user->department()->associate($request->input('department'));
//         $user->save();
//     });

//     return redirect('/admin')->with('success', 'User created successfully with the default password.');
// }

public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email|max:255',
        'roles' => 'required|array',
        'department' => 'nullable|exists:departments,id',
        'cycles' => 'array',
        'modules' => 'array', // Add validation for modules
    ]);

    DB::transaction(function () use ($request) {
        // Create a new user with a default password '12341234'
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('12341234'),
        ]);

        $user->save();

        // Sync roles for the user
        $user->roles()->sync($request->input('roles'));

        // Sync cycles for the user
        $user->cycles()->sync($request->input('cycles', []));

        // Sync modules for the user
        $user->modules()->sync($request->input('modules', []));

        // Associate the selected department with the user if provided
        $user->department()->associate($request->input('department'));
        $user->save();
    });

    return redirect('/admin')->with('success', 'User created successfully with the default password.');
}
    
    public function changePasswordForm()
    {
        return view('users.changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = auth()->user(); // Assuming you are working with the currently authenticated user

        // Check if the current password matches the user's password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        $userRoles = $user->roles;

        // Check if the user has the 'admin' role
        if ($userRoles->contains('name', 'admin')) {
            // Redirect to the admin page
            return redirect('/admin')->with('success', 'Password changed successfully.');
        } else {
            // Redirect to the home page
            return redirect('/home')->with('success', 'Password changed successfully.');
        }
    }

    public function getRoleNames()
    {
        return $this->roles()->pluck('name')->toArray();
    }


}
