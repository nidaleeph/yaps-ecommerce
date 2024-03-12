<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WatchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guestOrVerified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/category/{category:slug}', [ProductController::class, 'byCategory'])->name('byCategory');
    Route::get('/product/{product:slug}', [ProductController::class, 'view'])->name('product.view');

    Route::prefix('/cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product:slug}', [CartController::class, 'add'])->name('add');
        Route::post('/remove/{product:slug}', [CartController::class, 'remove'])->name('remove');
        Route::post('/update-quantity/{product:slug}', [CartController::class, 'updateQuantity'])->name('update-quantity');
    });

    Route::prefix('/product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
    });

    Route::prefix('/watch')->name('watch.')->group(function () {
        Route::get('/', [WatchController::class, 'index'])->name('index');
    });
    Route::get('/watch-category/{categoryWatch:slug}', [WatchController::class, 'byCategory'])->name('byWatchCategory');

    Route::get('/watch/{watch:slug}', [WatchController::class, 'view'])->name('watch.view');

    Route::get('/about', function () {
        return view('about.index');
    })->name('about.index');

    Route::get('/give', function () {
        return view('give.index');
    })->name('give.index');

    Route::get('/ministries', function () {
        return view('ministries.index');
    })->name('ministries.index');


    // Route::prefix('/resources')->name('resources.')->group(function () {
    //     Route::get('/salvation', function () {
    //         return view('resources/salvation.lesson1');
    //     })->name('salvation.lesson1');
    // });
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::prefix('/resources')->name('resources.')->group(function () {
        Route::prefix('/salvation')->name('salvation.')->group(function () {
            Route::get('/lesson-1', function () {
                return view('resources/salvation.lesson1');
            })->name('lesson1');
            Route::get('/lesson-2', function () {
                return view('resources/salvation.lesson2');
            })->name('lesson2');
            Route::get('/lesson-3', function () {
                return view('resources/salvation.lesson1');
            })->name('lesson3');
            Route::get('/lesson-4', function () {
                return view('resources/salvation.lesson1');
            })->name('lesson4');
        });
        Route::prefix('/growth')->name('growth.')->group(function () {
            Route::get('/lesson-1', function () {
                return view('resources/salvation.lesson1');
            })->name('lesson1');
            Route::get('/lesson-2', function () {
                return view('resources/salvation.lesson1');
            })->name('lesson2');
            Route::get('/lesson-3', function () {
                return view('resources/salvation.lesson1');
            })->name('lesson3');
        });
    });
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.update');
    Route::post('/profile/password-update', [ProfileController::class, 'passwordUpdate'])->name('profile_password.update');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkoutCustom', [CheckoutController::class, 'checkoutCustom'])->name('cart.checkoutCustom');
    Route::post('/checkout/{order}', [CheckoutController::class, 'checkoutOrder'])->name('cart.checkout-order');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/failure', [CheckoutController::class, 'failure'])->name('checkout.failure');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/{order}', [OrderController::class, 'view'])->name('order.view');
});

Route::post('/webhook/stripe', [CheckoutController::class, 'webhook']);

require __DIR__ . '/auth.php';

Route::fallback(function () {
    return view('errors.404'); // You can customize the view name as needed
});
