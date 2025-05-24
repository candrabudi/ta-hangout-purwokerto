<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackofficeCoffeeShopController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HangoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/directories', [HomeController::class, 'directories'])->name('home.directories');
Route::get('/directories/{slug}', [HomeController::class, 'show'])->name('home.directories.show');
Route::post('/directories/{slug}/interact', [HomeController::class, 'interact'])->name('hangout.interact');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('hangout')->name('hangout.')->group(function () {
        Route::get('/', [HangoutController::class, 'index'])->name('index');
        Route::get('/create', [HangoutController::class, 'create'])->name('create');
        Route::post('/store', [HangoutController::class, 'store'])->name('store');
        Route::get('/{a}/edit', [HangoutController::class, 'edit'])->name('edit');
        Route::put('/{a}/update', [HangoutController::class, 'update'])->name('update');
        Route::delete('/{a}/destroy', [HangoutController::class, 'destroy'])->name('destroy');
        Route::delete('/images/{image}/destroy', [HangoutController::class, 'destroyImage'])->name('delete.image');
        Route::post('/upload/image', [HangoutController::class, 'upload'])->name('upload.image');
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/visitors', [VisitorController::class, 'index'])->name('visitor.index');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});