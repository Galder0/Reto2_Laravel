<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{   
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'department_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'department_id' => $request->input('department_id'),
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'department_id' => $user->department_id,
            ],
        ])->setStatusCode(Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Username or password incorrect',
            ])->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'name' => $user->name,
            'token' => $user->createToken($request->device_name)->plainTextToken,
        ]);
    }

    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully',
        ])->setStatusCode(Response::HTTP_OK);
    }
}