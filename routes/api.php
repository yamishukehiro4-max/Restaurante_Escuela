<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DishCategoryController;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\RawMaterialCategoryController;
use App\Http\Controllers\Api\RawMaterialController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\PurchaseRequestController;
use App\Http\Controllers\Api\RawMaterialMovementController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\GoodsReceiptActController;
use App\Http\Controllers\Api\PurchaseInvoiceController;
use App\Http\Controllers\Api\CashRegisterClosingController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\StudentPracticeController;
use App\Http\Controllers\Api\UtensilController;
use App\Http\Controllers\Api\ExternalEventController;
use App\Http\Controllers\Api\GasProrationController;

Route::get('/login', function () {
    return response()->json([
        'error'   => 'No autenticado.',
        'message' => 'Enviá: Authorization: Bearer <token>',
        'login_endpoint' => '/api/v1/login',
    ], 401);
})->name('login');

Route::prefix('v1')->group(function () {

    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);

        // ---------- ACCESO GENERAL (todos los roles logueados) ----------
        Route::apiResource('dishes', DishController::class)->only(['index', 'show']);
        Route::apiResource('dish-categories', DishCategoryController::class)->only(['index', 'show']);
        Route::apiResource('raw-materials', RawMaterialController::class)->only(['index', 'show']);
        Route::apiResource('raw-material-categories', RawMaterialCategoryController::class)->only(['index', 'show']);
        Route::apiResource('suppliers', SupplierController::class)->only(['index', 'show']);
        Route::apiResource('recipes', RecipeController::class)->only(['index', 'show']);

        // ---------- VENTAS (Alumno Caja, Administrador) ----------
        Route::middleware('role:Administrador,Alumno Caja')->group(function () {
            Route::apiResource('sales', SaleController::class);
            Route::apiResource('cash-register-closings', CashRegisterClosingController::class);
            Route::apiResource('orders', OrderController::class);
        });

        // ---------- PRODUCCIÓN (Chef, Administrador) ----------
        Route::middleware('role:Administrador,Chef')->group(function () {
            Route::apiResource('dishes', DishController::class)->except(['index', 'show']);
            Route::apiResource('dish-categories', DishCategoryController::class)->except(['index', 'show']);
            Route::apiResource('recipes', RecipeController::class)->except(['index', 'show']);
            Route::apiResource('purchase-requests', PurchaseRequestController::class);
            Route::apiResource('raw-material-movements', RawMaterialMovementController::class);
            Route::get('raw-materials/{rawMaterial}/kardex', [RawMaterialMovementController::class, 'kardex']);
            Route::apiResource('goods-receipt-acts', GoodsReceiptActController::class);
            Route::apiResource('external-events', ExternalEventController::class);
            Route::post('external-events/{externalEvent}/approve', [ExternalEventController::class, 'approve']);
        });

        // ---------- COMPRAS (Compras, Administrador) ----------
        Route::middleware('role:Administrador,Compras')->group(function () {
            Route::apiResource('suppliers', SupplierController::class)->except(['index', 'show']);
            Route::apiResource('purchase-orders', PurchaseOrderController::class);
            Route::apiResource('purchase-invoices', PurchaseInvoiceController::class);
            Route::post('purchase-invoices/{purchaseInvoice}/pay', [PurchaseInvoiceController::class, 'markAsPaid']);
            Route::apiResource('raw-materials', RawMaterialController::class)->except(['index', 'show']);
            Route::apiResource('raw-material-categories', RawMaterialCategoryController::class)->except(['index', 'show']);
            Route::apiResource('gas-prorations', GasProrationController::class);
        });

        // ---------- ADMINISTRACIÓN TOTAL ----------
        Route::middleware('role:Administrador')->group(function () {
            Route::apiResource('roles', RoleController::class);
            Route::apiResource('users', UserController::class);
            Route::apiResource('customers', CustomerController::class);
            Route::apiResource('student-practices', StudentPracticeController::class);
            Route::apiResource('utensils', UtensilController::class);
        });
    });
});