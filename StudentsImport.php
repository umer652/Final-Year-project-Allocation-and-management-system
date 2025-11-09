<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $user = User::create([
            'name' => $row['name'],
            'email' => $row['email'],
            'reg_no' => $row['reg_no'],
            'role' => 'student',
            'password' => bcrypt('123456'), // default password
        ]);

        return new Student([
            'user_id' => $user->id,
            'section' => $row['section'],
            'cgpa' => $row['cgpa'],
        ]);
    }
}
