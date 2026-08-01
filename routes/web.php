<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DesignerDashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\DoctorController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DesignerDashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('doctors', DoctorController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';