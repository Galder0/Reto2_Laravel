<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    // In your controller
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.index', compact('users'));
    }

}