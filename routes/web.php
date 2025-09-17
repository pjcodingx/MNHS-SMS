<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\registrar\RegistrarDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showloginform'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//!Admin
Route::middleware(['admin'])->prefix('admin')->group(function (){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/registrar', [RegistrarController::class, 'create'])->name('admin.registrars.create');
    Route::post('/registrar/create', [RegistrarController::class, 'store'])->name('admin.registrars.store');
});







Route::middleware(['student'])->prefix('student')->group( function(){
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

Route::middleware(['faculty'])->prefix('faculty')->group( function(){
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('faculty.dashboard');
});



//!REgistrar
Route::middleware(['registrar'])->prefix('registrar')->group( function(){
    Route::get('/dashboard', [RegistrarDashboardController::class, 'dashboard'])->name('registrar.dashboard');
});


