<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    // ✅ Get all students with user details
    public function index()
    {
        $students = Student::with('user')->get();

        return response()->json([
            'status' => true,
            'message' => 'All students fetched successfully',
            'data' => $students
        ]);
    }

    // ✅ Create new student manually
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id|unique:students,user_id',
            'section' => 'required|string|max:10',
            'cgpa' => 'required|numeric|between:0,4.0',
        ]);

        $student = Student::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Student created successfully',
            'data' => $student
        ], 201);
    }

    // ✅ Show student by ID (with user)
    public function show($id)
    {
        $student = Student::with('user')->find($id);

        if (!$student) {
            return response()->json(['status' => false, 'message' => 'Student not found'], 404);
        }

        return response()->json(['status' => true, 'data' => $student]);
    }

    // ✅ Find student by registration number (user_id)
   public function findByRegNo(Request $request)
{
    $regNo = $request->query('user_id');

    $student = Student::with('users')
        ->where('user_id', $regNo) // match student.user_id = users.user_id
        ->first();

    if (!$student) {
        return response()->json([
            'status' => false,
            'message' => 'Student record not found for this registration number'
        ], 404);
    }

    return response()->json([
        'status' => true,
        'data' => $student
    ]);
}


    // ✅ Update student
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['status' => false, 'message' => 'Student not found'], 404);
        }

        $validated = $request->validate([
            'section' => 'sometimes|string|max:10',
            'cgpa' => 'sometimes|numeric|between:0,4.0',
        ]);

        $student->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Student updated successfully',
            'data' => $student
        ]);
    }

    // ✅ Delete student
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['status' => false, 'message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['status' => true, 'message' => 'Student deleted successfully']);
    }

    // ✅ Import students from Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ]);

        $file = $request->file('file');
        $data = Excel::toArray([], $file);
        $rows = $data[0]; // First sheet

        $inserted = 0;
        $skipped = [];

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Skip header row

            $registrationNumber = $row[0] ?? null;
            $section = $row[1] ?? null;
            $cgpa = $row[2] ?? null;

            if (!$registrationNumber) continue;

            $user = User::where('id', $registrationNumber)->first();

            if ($user && !Student::where('user_id', $user->id)->exists()) {
                Student::create([
                    'user_id' => $user->id,
                    'section' => $section,
                    'cgpa' => $cgpa,
                ]);
                $inserted++;
            } else {
                $skipped[] = $registrationNumber;
            }
        }

        $message = "$inserted student(s) imported successfully.";
        if (count($skipped)) {
            $message .= " Skipped: " . implode(', ', $skipped);
        }

        return response()->json(['status' => true, 'message' => $message]);
    }
}
