<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Add this line
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function assignRolesForm(User $user)
    {
        $roles = Role::all();
        $usersRoles = $user->roles; //->pluck('id')->toArray();

        return view('users.assignRoles', compact('user', 'roles', 'usersRoles'));
    }

    public function assignRoles(Request $request, User $user)
{
    $request->validate([
        'roles' => 'required|array',
    ]);

    DB::transaction(function () use ($request, $user) {
        // Sync roles for the user
        $user->roles()->sync($request->input('roles'));
    });

    return redirect('/admin')->with('success', 'Roles assigned successfully.');

}

    public function destroy(User $user)
    {
        DB::transaction(function () use ($user) {
            // Detach roles before deleting the user
            $user->roles()->detach();

            // Delete the user
            $user->delete();
        });

         $users = User::paginate(20);
        return view('admin.index', compact('users'));
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles;

        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $user) {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);

            // Sync roles for the user
            $user->roles()->sync($request->input('roles'));
        });

        return redirect('/admin')->with('success', 'User updated successfully.');
    }
    
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

}
