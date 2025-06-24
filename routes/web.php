<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::get('/lista-usuarios', [UserController::class,'index'])->name('user.index');
    Route::get('/user-editar/{id}', [UserController::class,'edit'])->name('user.edit');
    Route::put('/edit-update/{id}', [UserController::class,'update'])->name('user.update');
});

require __DIR__.'/auth.php';
