<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\Faculty;
use App\Http\Middleware\Student;
use App\Http\Middleware\Registrar;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //This is where we add the Models
        $middleware->alias([
            'admin' => Admin::class,
            'student' => Student::class,
            'faculty' => Faculty::class,
            'registrar' => Registrar::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
