<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\AdviserController;
use App\Http\Controllers\admin\SectionController;
use App\Http\Controllers\admin\SubjectController;
use App\Http\Controllers\admin\ScheduleController;
use App\Http\Controllers\Admin\SectionSubjectController;
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


    //sections
   Route::get('/sections', [SectionController::class, 'index'])->name('admin.sections.index');
    Route::get('/sections/create', [SectionController::class, 'create'])->name('admin.sections.create');
    Route::post('/sections', [SectionController::class, 'store'])->name('admin.sections.store');
    Route::get('/sections/{section}/edit', [SectionController::class, 'edit'])->name('admin.sections.edit');

    //subjects
    Route::get('/subjects', [SubjectController::class, 'index'])->name('admin.subjects.index');
    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('admin.subjects.create');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('admin.subjects.store');
     Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('admin.subjects.edit');
    Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('admin.subjects.update');



        // Advisers
    Route::get('/advisers', [AdviserController::class, 'index'])->name('admin.advisers.index');
    Route::get('/advisers/create', [AdviserController::class, 'create'])->name('admin.advisers.create');
    Route::post('/advisers', [AdviserController::class, 'store'])->name('admin.advisers.store');
    Route::get('/advisers/{adviser}/edit', [AdviserController::class, 'edit'])->name('admin.advisers.edit');
    Route::put('/advisers/{adviser}', [AdviserController::class, 'update'])->name('admin.advisers.update');
    Route::delete('/advisers/{adviser}', [AdviserController::class, 'destroy'])->name('admin.advisers.destroy');

    //section subjecst
    Route::get('/section_subjects', [SectionSubjectController::class, 'index'])->name('admin.section_subjects.index');
    Route::get('/section_subjects/create', [SectionSubjectController::class, 'create'])->name('admin.section_subjects.create');
    Route::post('/section_subjects', [SectionSubjectController::class, 'store'])->name('admin.section_subjects.store');
     Route::get('/section_subjects/{sectionSubject}/edit', [SectionSubjectController::class, 'edit'])->name('admin.section_subjects.edit');

    //schedules

     Route::get('/schedules', [ScheduleController::class, 'index'])->name('admin.schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('admin.schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('admin.schedules.store');
    Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('admin.schedules.edit');


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


