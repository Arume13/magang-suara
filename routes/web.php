<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\UserStatusController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users/{id}', [UserController::class, 'update']);
// Route::get('users/{id}/edit', [UserController::class, 'index'])->middleware(['auth', 'verified','role:admin']);
Route::get('users/{id}/show', [UserController::class, 'show'])->name('users.show');
Route::resource('users', UserController::class);


Route::get('/user-status', [UserStatusController::class, 'index']);
Route::patch('/user-status/activate/{id}', [UserStatusController::class, 'activate']);
Route::patch('/user-status/in_activate/{id}', [UserStatusController::class, 'in_activate']);
Route::get('/user-status/{id}', [UserStatusController::class, 'getStatus']);


Route::get('/user_import', [UserExportController::class, 'index'])->name('import.index');
Route::post('/import', [UserExportController::class, 'import'])->name('import.user');
Route::get('/user_export', [UserExportController::class, 'export'])->name('export.user');

Route::get('roles', [RolesController::class, 'index'])-> name ('roles.index');
Route::post('roles/{id}', [RolesController::class, 'update'])-> name ('roles.update');
Route::get('roles/{id}/edit', [RolesController::class, 'edit']);

Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');

require __DIR__.'/auth.php';
