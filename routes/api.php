<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\OnlyAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/auth')->middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('getuser', [AuthController::class, 'getUser']);
});

Route::prefix('/admin')
    ->group(function () {
        Route::get('/', [HomeController::class, 'admin']);
        //User
        Route::get('/user', [HomeController::class, 'user']);
        // Unit
        Route::get('/unit', [UnitController::class, 'unit']);
        Route::post('/unit', [UnitController::class, 'create']);
        Route::get('/unit/{id}', [UnitController::class, 'view']);
        Route::post('/unit/update/{id}', [UnitController::class, 'update']);
        Route::delete('/unit/delete/{id}', [UnitController::class, 'delete']);
        // Category
        Route::get('/category', [CategoryController::class, 'category']);
        Route::post('/category', [CategoryController::class, 'create']);
        Route::get('/category/{id}', [CategoryController::class, 'view']);
        Route::post('/category/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/category/delete/{id}', [CategoryController::class, 'delete']);
        // Warehouse
        Route::get('/warehouse', [WarehouseController::class, 'warehouse']);
        Route::post('/warehouse', [WarehouseController::class, 'create']);
        Route::get('/warehouse/{id}', [WarehouseController::class, 'view']);
        Route::post('/warehouse/update/{id}', [WarehouseController::class, 'update']);
        Route::delete('/warehouse/delete/{id}', [WarehouseController::class, 'delete']);
        // Item
        Route::post('/item', [ItemController::class, 'create']);
        Route::get('/item/{id}', [ItemController::class, 'view']);
        Route::post('/item/update/{id}', [ItemController::class, 'update']);
        Route::delete('/item/delete/{id}', [ItemController::class, 'delete']);
        
    });

Route::post('/auth/login', [AuthController::class, 'login']);