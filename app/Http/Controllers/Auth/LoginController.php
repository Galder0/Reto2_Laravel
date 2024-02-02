<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Check if the user has the 'admin' role
        if ($user->hasRole('admin')) {
            return redirect('/admin');
        }

        // Redirect to the default home page
        return redirect($this->redirectTo);
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}