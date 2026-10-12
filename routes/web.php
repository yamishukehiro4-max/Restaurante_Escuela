<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\DishWebController;

// ---------- AUTENTICACIÓN WEB ----------
Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthWebController::class, 'login']);
Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');

// ---------- RUTAS PÚBLICAS ----------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/docs', [HomeController::class, 'docs'])->name('docs');
Route::get('/playground', [HomeController::class, 'playground'])->name('playground');

// ---------- DASHBOARD (protegido) ----------
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});

// ---------- ADMIN (CRUD de platillos) ----------
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('dishes', [DishWebController::class, 'index'])->name('admin.dishes.index');
    Route::get('dishes/create', [DishWebController::class, 'create'])->name('admin.dishes.create');
    Route::post('dishes', [DishWebController::class, 'store'])->name('admin.dishes.store');
    Route::get('dishes/{dish}/edit', [DishWebController::class, 'edit'])->name('admin.dishes.edit');
    Route::put('dishes/{dish}', [DishWebController::class, 'update'])->name('admin.dishes.update');
    Route::delete('dishes/{dish}', [DishWebController::class, 'destroy'])->name('admin.dishes.destroy');
});