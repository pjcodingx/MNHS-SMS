<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showloginform'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');



Route::middleware(['admin'])->prefix('admin')->group(function (){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['student'])->prefix('student')->group( function(){
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

Route::middleware(['faculty'])->prefix('faculty')->group( function(){
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('faculty.dashboard');
});

Route::middleware(['registrar'])->prefix('registrar')->group( function(){
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('registrar.dashboard');
});


