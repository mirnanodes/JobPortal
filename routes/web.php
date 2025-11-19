<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('jobs.index');
    }
    return redirect()->route('jobs.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes untuk semua user yang login
Route::middleware(['auth'])->group(function () {
    Route::resource('jobs', JobController::class)->only(['index', 'show']);
    
    // Route untuk apply job (jobseeker only)
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
        ->name('apply.store');
});

// Routes khusus admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('jobs', JobController::class)->except(['index', 'show']);
    Route::post('/jobs/import', [JobController::class, 'import'])->name('jobs.import');
    
    Route::resource('applications', ApplicationController::class)->except(['index', 'show']);
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/export', [ApplicationController::class, 'export'])->name('applications.export');
});

require __DIR__.'/auth.php';