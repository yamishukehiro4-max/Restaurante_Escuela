<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\DishWebController;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\SupplierWebController;
use App\Http\Controllers\RawMaterialWebController;

// ============================================================
// PÚBLICO — SOLO el login
// ============================================================
Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthWebController::class, 'login']);
Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');

// ============================================================
// PROTEGIDO — TODO lo demás requiere login
// ============================================================
Route::middleware('auth')->group(function () {

    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/docs', [HomeController::class, 'docs'])->name('docs');
    Route::get('/playground', [HomeController::class, 'playground'])->name('playground');
    Route::get('/api/chart-data', [HomeController::class, 'chartData']);
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Página QR
    Route::get('/qr', function () {
        $ip = request()->getHost();
        $url = 'http://' . $ip . ':' . request()->getPort();
        return view('qr', compact('url'));
    })->name('qr');

    // Admin (CRUDs)
    Route::prefix('admin')->group(function () {
        // Platillos
        Route::get('dishes', [DishWebController::class, 'index']);
        Route::get('dishes/create', [DishWebController::class, 'create']);
        Route::post('dishes', [DishWebController::class, 'store']);
        Route::get('dishes/{dish}/edit', [DishWebController::class, 'edit']);
        Route::put('dishes/{dish}', [DishWebController::class, 'update']);
        Route::delete('dishes/{dish}', [DishWebController::class, 'destroy']);

        // Usuarios
        Route::get('users', [UserWebController::class, 'index']);
        Route::post('users', [UserWebController::class, 'store']);
        Route::put('users/{user}', [UserWebController::class, 'update']);
        Route::delete('users/{user}', [UserWebController::class, 'destroy']);

        // Proveedores
        Route::get('suppliers', [SupplierWebController::class, 'index']);
        Route::post('suppliers', [SupplierWebController::class, 'store']);
        Route::put('suppliers/{supplier}', [SupplierWebController::class, 'update']);
        Route::delete('suppliers/{supplier}', [SupplierWebController::class, 'destroy']);

        // Materia Prima
        Route::get('raw-materials', [RawMaterialWebController::class, 'index']);
        Route::post('raw-materials', [RawMaterialWebController::class, 'store']);
        Route::put('raw-materials/{rawMaterial}', [RawMaterialWebController::class, 'update']);
        Route::delete('raw-materials/{rawMaterial}', [RawMaterialWebController::class, 'destroy']);
    });
});