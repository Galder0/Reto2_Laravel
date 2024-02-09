<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    /**
     * Reset the user's password and send a password reset email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // If user not found, return error response
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Generate a password reset token for the user
        $token = Password::createToken($user);

        // Generate the password reset link
        $resetLink = route('password.reset', ['token' => $token, 'email' => $user->email]);

        // Send the password reset email
        Mail::to($user->email)->send(new ResetPasswordEmail($resetLink));

        // Return success response
        return response()->json(['message' => 'Password reset email sent'], 200);
    }
}