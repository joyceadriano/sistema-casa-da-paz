<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('images', [ImageController::class, 'index'])->name('images.index');
    Route::get('images/create', [ImageController::class, 'create'])->name('images.create');
    Route::post('images', [ImageController::class, 'store'])->name('images.store');
    Route::get('images/{id}/edit', [ImageController::class, 'edit'])->name('images.edit');
    Route::put('images/{id}', [ImageController::class, 'update'])->name('images.update');
    Route::delete('images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');
});

Route::get('api/images', [ImageController::class, 'getAllImages']);
