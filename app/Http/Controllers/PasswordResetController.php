<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PasswordResetController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return Redirect::back()->with('error', 'We could not find a user with that email address.');
        }

        // Generate a password reset token for the user
        $token = Password::createToken($user);

        // Generate the password reset link
        $resetLink = route('password.reset', ['token' => $token, 'email' => $user->email]);

        // Send the password reset email
        Mail::to($user->email)->send(new ResetPasswordEmail($resetLink));

        // Retrieve the updated user data
        $user = User::where('email', $request->email)->firstOrFail();

        // Log in the user using the retrieved user data
        Auth::login($user);

        // Redirect the user to the appropriate page or return a response
        return redirect()->route('home')->with('success', 'Your password has been successfully changed.');
    }
}