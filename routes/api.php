<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\StockTransferController;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/inventory', [InventoryController::class, 'index']);
    Route::post('/stock-transfers', [StockTransferController::class, 'store']);
    Route::get('/warehouses/{id}/inventory', [InventoryController::class, 'warehouseInventory']);
});



