<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Cycle;
use App\Models\Module;


class AdminController extends Controller
{
    // In your controller
    public function index(User $user)
    {
        $users = User::paginate(20);
        $roles = Role::all();
        $departments = Department::all();
        $cycles = Cycle::all();
        $modules = Module::all();
        return view('admin.index', compact('user', 'users', 'roles', 'departments', 'cycles', 'modules'));
    }

}