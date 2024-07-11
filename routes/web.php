<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/userphotos/{userId}/upload', [UserPhotoController::class, 'upload'])->name('uploadPhoto');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [UserPhotoController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/delete/{photoId}', [UserPhotoController::class, 'delete'])->name('photo.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
