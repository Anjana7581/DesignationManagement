<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\UserController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard'); // Normal user dashboard
    })->name('dashboard');

// Admin Routes (Only for Admins)
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Admin dashboard
    })->name('admin.dashboard');

    Route::get('/admin/designations', [DesignationController::class, 'index'])->name('admin.designations.index');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
});


   
    

    // User Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
