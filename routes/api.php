<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditProductController;
use App\Http\Controllers\CreateProductController;

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

Route::middleware(['api-session'])->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/email', [AuthController::class, 'loginEmail'])->name('emaillogin');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/login/email', [AuthController::class, 'showEmailLoginForm'])->name('emaillogin');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard');

        Route::get('/create', [CreateProductController::class, 'showCreate'])->name('create');
        Route::post('/create/products', [CreateProductController::class, 'create']);

        Route::get('/videos', [VideosController::class, 'showVideos'])->name('videos');

        Route::get('/products', [DashboardController::class, 'index']);
        Route::get('/products/search', [DashboardController::class, 'indexSearch']);
        Route::delete('/products/{id}', [DashboardController::class, 'destroy']);

        Route::get('/products/edit/{id}', [EditProductController::class, 'showEditProduct'])->name('products.edit');
        Route::get('/products/{product_id}/images', [EditProductController::class, 'getImages']);
        Route::post('/products/update/{id}', [EditProductController::class, 'update']);

    });
});



