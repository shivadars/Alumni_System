<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

// Profile Setup Routes (Accessible even if profile is incomplete)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile/setup', [App\Http\Controllers\UserProfileController::class, 'create'])->name('profile.create');
    Route::get('/profile/edit', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('profile.edit-details');
    Route::post('/profile/setup', [App\Http\Controllers\UserProfileController::class, 'store'])->name('profile.store-details');
    Route::get('/profile/{user?}', [App\Http\Controllers\UserProfileController::class, 'show'])->name('profile.show');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'profile.complete'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin', 'profile.complete'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Student Routes
Route::middleware(['auth', 'role:student', 'profile.complete'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Alumni Routes
Route::middleware(['auth', 'role:alumni', 'profile.complete'])->prefix('alumni')->name('alumni.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Posts Routes
Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
});

// Alumni Search Routes
Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/alumni/search', [App\Http\Controllers\AlumniSearchController::class, 'index'])->name('alumni.search');
});

// Admin User Management Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [App\Http\Controllers\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/approve', [App\Http\Controllers\AdminUserController::class, 'approve'])->name('admin.users.approve');
    Route::post('/admin/users/{user}/reject', [App\Http\Controllers\AdminUserController::class, 'reject'])->name('admin.users.reject');
    Route::delete('/admin/users/{user}', [App\Http\Controllers\AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

// Private Messaging Routes
Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
});

require __DIR__.'/auth.php';
