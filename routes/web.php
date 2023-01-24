<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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


Route::get('/', [HomeController::class, 'index'])->name('index');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->middleware('throttle:login')->name('login');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'auth', 'as' => 'admin.'], function () {

        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('edit/{id?}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('save/{id?}', [CategoryController::class, 'save'])->name('save');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('edit/{id?}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('save/{id?}', [CategoryController::class, 'save'])->name('save');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
        });

    });
});

// Route::get('/product/{product}', [ProductController::class, 'product'])->name('product');
