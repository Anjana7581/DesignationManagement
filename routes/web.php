<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DashboardController;

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
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


        Route::get('/admin/designations', [DesignationController::class, 'index'])->name('admin.designations.index');
        Route::get('/admin/designations/create', [DesignationController::class, 'create'])->name('admin.designations.create');
        Route::post('/admin/designations', [DesignationController::class, 'store'])->name('admin.designations.store');
        Route::get('/admin/designations/{id}/edit', [DesignationController::class, 'edit'])->name('admin.designations.edit');
        Route::put('/admin/designations/{id}', [DesignationController::class, 'update'])->name('admin.designations.update');
    
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::post('/admin/users/filter', [UserController::class, 'filter'])->name('admin.users.filter');


});


   
    

    // User Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
