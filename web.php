<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

// Default Login Page
Route::get('/', function () {
    return view('login');
})->name('login');

// 🔹 Handle login POST request
Route::post('/login', [AuthController::class, 'webLogin'])->name('login.post');

// 🔹 Admin Dashboard Route
Route::get('/admin/dashboard', function () {
    return view('Admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

// Admin Upload Routes
Route::get('/admin/upload-student', function () {
    return view('Admin.UploadStudent');
})->name('admin.upload_student');

Route::post('/admin/upload-student', [StudentController::class, 'import'])
    ->name('admin.upload_student.upload');

Route::get('/admin/upload-commettie', function () {
    return view('Admin.uploadcommettie');
})->name('admin.upload_commettie');

Route::get('/admin/upload-teacher', function () {
    return view('Admin.uploadteacher');
})->name('admin.upload_teacher');

Route::get('/admin/supervisorSelection', function () {
    return view('Admin.supervisorselection');
})->name('admin.supervisorselection');



Route::get('/student', function () {
    return view('student.create_group');
})->name('student');

Route::get('/createproject', function () {
    return view('student.project');
})->name('project');

Route::get('/meeting',function(){
    return view('student.meeting');
})->name('meeting');

Route::get('/student/project', function () {
    return view('project');
})->name('project');

Route::get('/new-project', function () {
    return view('student.new_project');
})->name('student.new_project');