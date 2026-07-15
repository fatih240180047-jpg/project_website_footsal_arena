<?php

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
        $middleware->alias([
            'cek.peran' => \App\Http\Middleware\CekPeran::class,
        ]);
        
        $middleware->redirectUsersTo(function () {
            if (auth()->check()) {
                return auth()->user()->peran === 'admin' 
                    ? route('admin.dashboard') 
                    : route('pelanggan.lapangan.index');
            }
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
