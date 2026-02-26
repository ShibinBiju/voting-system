<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VotingController;
use Illuminate\Support\Facades\Route;

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
    
    // Voter routes
    Route::middleware('role:voter')->group(function () {
        Route::get('/vote', [VotingController::class, 'index'])->name('vote.index');
        Route::post('/vote', [VotingController::class, 'store'])->name('vote.store');
        Route::get('/candidates', [VotingController::class, 'candidates'])->name('candidates.index');
    });
    
    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/results', [AdminController::class, 'results'])->name('admin.results');
        Route::resource('admin/candidates', \App\Http\Controllers\Admin\CandidateController::class)->names([
            'index' => 'admin.candidates.index',
            'create' => 'admin.candidates.create',
            'store' => 'admin.candidates.store',
            'edit' => 'admin.candidates.edit',
            'update' => 'admin.candidates.update',
            'destroy' => 'admin.candidates.destroy',
        ]);
    });
});

require __DIR__.'/auth.php';
