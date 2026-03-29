<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// TEMPORARY DIAGNOSTIC ROUTE - DELETE AFTER USE
Route::get('/debug-auth', function () {
    try {
        $admins = User::where('role', 'admin')->get(['email', 'name', 'role', 'status']);
        $totalUsers = User::count();
        $dbName = config('database.connections.pgsql.database');
        
        return [
            'status' => 'Diagnostic active',
            'database' => [
                'name' => $dbName,
                'total_users' => $totalUsers,
            ],
            'admins_found' => $admins->map(fn($u) => [
                'email' => $u->email,
                'role' => $u->role,
                'status' => $u->status,
                'password_length' => strlen($u->password), // Just check if it's hashing correctly
            ]),
            'environment' => [
                'app_url' => config('app.url'),
                'app_key_set' => !empty(config('app.key')),
            ],
            'debug_actions' => [
                'run_seeder' => url('/debug-seed')
            ]
        ];
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
});

Route::get('/debug-seed', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'AdminUserSeeder']);
        return [
            'status' => 'Seeder executed successfully',
            'output' => \Illuminate\Support\Facades\Artisan::output()
        ];
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
});

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
    Route::post('/posts/{post}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('posts.comments.store');
    Route::delete('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post}/like', [App\Http\Controllers\LikeController::class, 'toggle'])->name('posts.like.toggle');
    Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
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

// Department Routes (Accessible to all users with complete profile)
Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/department/list', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
    Route::get('/department/{department}', [App\Http\Controllers\DepartmentController::class, 'show'])->name('department.show');
});

// Event Routes
Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [App\Http\Controllers\EventController::class, 'create'])->name('events.create');
    Route::post('/events', [App\Http\Controllers\EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');
    Route::delete('/events/{event}', [App\Http\Controllers\EventController::class, 'destroy'])->name('events.destroy');
    Route::post('/events/{event}/attend', [App\Http\Controllers\EventController::class, 'attend'])->name('events.attend');
});

// Private Messaging Routes
Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
});

// Notification Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/notifications/mark-read', function() {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.mark-read');
});

require __DIR__.'/auth.php';
