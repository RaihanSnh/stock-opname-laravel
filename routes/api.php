<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\UnitController;
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
    Route::get('user', [AuthController::class, 'getUser']);
});

Route::prefix('/admin')
    ->group(function () {
        Route::get('/', [HomeController::class, 'admin']);
        Route::get('/unit', [UnitController::class, 'unit']);
        Route::post('/unit', [UnitController::class, 'create']);
        Route::get('/category', [CategoryController::class, 'category']);
        Route::post('/category', [CategoryController::class, 'create']);
        Route::post('/item', [ItemController::class, 'create']);
    });

Route::post('/auth/login', [AuthController::class, 'login']);