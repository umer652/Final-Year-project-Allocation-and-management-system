<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    // ----------------------------
    // GET all supervisors
    // ----------------------------
    public function index()
    {
        return response()->json(
            Supervisor::with('user')->get()
        );
    }

    // ----------------------------
    // GET single supervisor
    // ----------------------------
    public function show($id)
    {
        $supervisor = Supervisor::with('user')->find($id);

        if (!$supervisor) {
            return response()->json(['error' => 'Supervisor not found'], 404);
        }

        return response()->json($supervisor);
    }

    // ----------------------------
    // POST create supervisor
    // ----------------------------
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id', // use user_id, not id
            'domain'  => 'required|string|max:255',
        ]);

        // ✅ Find user by custom user_id (string)
        $user = User::where('user_id', $request->user_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // ✅ Role check (case-insensitive, trimmed)
        if (strtolower(trim($user->role)) !== 'supervisor') {
            return response()->json(['error' => 'Only users with role supervisor can be added'], 400);
        }

        // ✅ Avoid duplicate supervisor entries
        if (Supervisor::where('user_id', $request->user_id)->exists()) {
            return response()->json(['error' => 'This user is already added as a supervisor'], 400);
        }

        // ✅ Create supervisor entry
        $supervisor = Supervisor::create([
            'user_id' => $request->user_id,
            'domain'  => $request->domain,
        ]);

        return response()->json([
            'message' => 'Supervisor created successfully',
            'data' => $supervisor
        ], 201);
    }

    // ----------------------------
    // PUT update supervisor
    // ----------------------------
    public function update(Request $request, $id)
    {
        $supervisor = Supervisor::find($id);

        if (!$supervisor) {
            return response()->json(['error' => 'Supervisor not found'], 404);
        }

        $request->validate([
            'domain' => 'sometimes|string|max:255'
        ]);

        $supervisor->update($request->only('domain'));

        return response()->json([
            'message' => 'Supervisor updated successfully',
            'data' => $supervisor
        ]);
    }

    // ----------------------------
    // DELETE supervisor
    // ----------------------------
    public function destroy($id)
    {
        $supervisor = Supervisor::find($id);

        if (!$supervisor) {
            return response()->json(['error' => 'Supervisor not found'], 404);
        }

        $supervisor->delete();

        return response()->json(['message' => 'Supervisor deleted successfully']);
    }
}
