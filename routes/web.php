<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;


// Route for Login and Registration
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);


// Routes for Admin, Manager, and User Dashboards
Route::middleware(['auth'])->group(function () {

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        // Add other Admin-only routes here
    });

    Route::group(['middleware' => ['role:Manager']], function () {
        Route::get('/manager/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
        // Add other Manager-only routes here
    });

    Route::group(['middleware' => ['role:User']], function () {
        Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
        // Add other User-only routes here
    });

    // Common authenticated routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Default Dashboard Route
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';