<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Routes for Authenticated Users
Route::middleware(['auth'])->group(function () {

    // Redirect users based on role after login
    Route::get('/dashboard', function () {
        if (Auth::user()->isAdmin()) {
            return redirect('/admin/dashboard');
        }
        return view('dashboard'); // Normal user dashboard
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard'); // Admin dashboard
        })->name('admin.dashboard');

        Route::resource('designations', DesignationController::class);
        Route::resource('users', UserController::class);
    });

    // User Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
