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
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('users.assignRoles', compact('user', 'roles', 'userRoles'));
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

        return redirect()->route('users.show', $user)->with('success', 'Roles assigned successfully.');
    }
}
