<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ✅ Show all users
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'message' => 'All users fetched successfully',
            'data' => $users
        ], 200);
    }

    // ✅ Show single user
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    // ✅ Create new user
    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'user_id' => 'required|unique:users',
            'Name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'Role' => 'required'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }

    // ✅ Update user
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|string|unique:users,user_id,' . $user->id,
            'Name' => 'sometimes|string|max:255',
            'username' => 'sometimes|string|max:255|unique:users,UserName,' . $user->id,
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:6',
            'Role' => 'sometimes|in:Admin,Commettie,Supervisor,Student',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->Password);
        }

        $user->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ], 200);
    }

    // ✅ Delete user
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}
