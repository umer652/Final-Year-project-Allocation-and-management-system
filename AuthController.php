<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    // 🔹 Web Login (Blade-based)
    public function webLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find user by username
        $user = User::where('username', $request->username)->first();

        // Check if user exists and password matches (manual check)
        if ($user && Hash::check($request->password, $user->password)) {

            // Log the user in manually
            Auth::login($user);

            // Redirect based on role
            switch (strtolower($user->Role)) {
                case 'admin':
                    return redirect()->route('admin.upload_student');
                case 'supervisor':
                    return redirect()->route('admin.supervisorselection');
                case 'student':
                    return redirect()->route('student');
                case 'commettie':
                    return redirect()->route('admin.upload_commettie');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'username' => 'User role not defined.',
                    ]);
            }
        }

        // Login failed
        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ]);
    }

    // 🔹 API Login (for Postman or mobile)
    public function apiLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Find the user
        $user = User::where('UserName', $request->username)->first();

        // Verify password manually
        if ($user && Hash::check($request->password, $user->Password)) {
            Auth::login($user);

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
            ], 200);
        }

        // Invalid login
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }
}
