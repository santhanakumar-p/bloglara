<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'showDataInHome'])->name('home');
Route::get('/fullpost/{id}', [UserController::class, 'showFullPost'])->name('fullpost');

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/allpost', [AdminController::class, 'allpost'])->name('allpost');
    Route::get('/dashboard/createpost', [AdminController::class, 'createpost'])->name('createpost');
    Route::post('/dashboard/storepost', [AdminController::class, 'storepost'])->name('storepost');
    Route::get('/dashboard/{id}/edit', [AdminController::class, 'editpost'])->name('editpost');
    Route::put('/dashboard/{id}', [AdminController::class, 'updatepost'])->name('updatepost');
    Route::delete('/dashboard/{id}', [AdminController::class, 'destroypost'])->name('destroypost');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
