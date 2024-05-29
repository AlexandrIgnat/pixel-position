<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [\App\Http\Controllers\JobController::class, 'index']);

Route::get('/jobs/create', [\App\Http\Controllers\JobController::class, 'create'])->middleware('auth');
Route::post('/jobs', [\App\Http\Controllers\JobController::class, 'store'])->middleware('auth');

Route::get('/search', \App\Http\Controllers\SearchController::class);
Route::get('/tags/{tag:name}', \App\Http\Controllers\TagController::class);