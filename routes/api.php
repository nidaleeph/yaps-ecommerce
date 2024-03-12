<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryWatchController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\WatchController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/user', [\App\Http\Controllers\Api\AuthController::class, 'getUser']);
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::apiResource('products', ProductController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('categories', CategoryController::class)->except('show');
    Route::apiResource('categoryWatch', CategoryWatchController::class)->except('show');
    Route::apiResource('events', EventsController::class)->except('show');
    Route::apiResource('watches', WatchController::class);


    Route::get('/categories/tree', [CategoryController::class, 'getAsTree']);
    Route::get('/categoryWatch/tree', [CategoryWatchController::class, 'getAsTree']);
    Route::get('/categoryWatch/categoryWithAll', [CategoryWatchController::class, 'categoryWithAll']);
    Route::get('/categories/categoryWithAll', [CategoryController::class, 'categoryWithAll']);
    Route::get('/countries', [CustomerController::class, 'countries']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/statuses', [OrderController::class, 'getStatuses']);
    Route::post('orders/change-status/{order}/{status}', [OrderController::class, 'changeStatus']);
    Route::get('orders/{order}', [OrderController::class, 'view']);
    Route::get('/getItemCount', [ProductController::class, 'getItemCount']);
    Route::get('/getItemCountWatch', [WatchController::class, 'getItemCount']);
    Route::post('/dashboard/csv', [DashboardController::class, 'downloadCsv']);
    Route::get('/products/category/csv/{id}', [ProductController::class, 'downloadProductCategoryCsv']);
    Route::get('/watches/category/csv/{id}', [WatchController::class, 'downloadWatchCategoryCsv']);


    // Dashboard Routes
    Route::get('/dashboard/customers-count', [DashboardController::class, 'activeCustomers']);
    Route::get('/dashboard/products-count', [DashboardController::class, 'activeProducts']);
    Route::get('/dashboard/orders-count', [DashboardController::class, 'paidOrders']);
    Route::get('/dashboard/income-amount', [DashboardController::class, 'totalIncome']);
    Route::get('/dashboard/alltime-income-amount', [DashboardController::class, 'allTimeTotalIncome']);
    Route::get('/dashboard/orders-by-category', [DashboardController::class, 'ordersByCategory']);
    Route::get('/dashboard/latest-customers', [DashboardController::class, 'latestCustomers']);
    Route::get('/dashboard/latest-orders', [DashboardController::class, 'latestOrders']);
    Route::post('/dashboard/all-items-price', [DashboardController::class, 'allItemPrice']);
    Route::get('/dashboard/get-activeEvent', [DashboardController::class, 'getActiveEvent']);

    // Report routes
    Route::get('/report/orders', [ReportController::class, 'orders']);
    Route::get('/report/customers', [ReportController::class, 'customers']);
});

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::get('/print/order/{id}', [OrderController::class, 'printOrder']);


