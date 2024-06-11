<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductPhotoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Models\ProductPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [HomeController::class, 'single'])->name('product.single');

Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.single');
Route::get('/store/{slug}', [App\Http\Controllers\StoreController::class, 'index'])->name('store.single');

Route::prefix('cart')->name('cart.')->group(function() {
    
    Route::get('', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::get('/remove/{slug}', [CartController::class, 'remove'])->name('remove');
    Route::get('/cancel', [CartController::class, 'cancel'])->name('cancel');

});

Route::prefix('checkout')->name('checkout.')->group(function() {
    
    Route::get('', [CheckoutController::class, 'index'])->name('index');
    Route::post('/proccess', [CheckoutController::class, 'proccess'])->name('proccess');

});

Route::group(['middleware'=> ['auth', 'user.is.owner']], function() {

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function() {

        Route::prefix('stores')->name('stores.')->group(function() {
            // Route::get('/', 'Admin\\StoreController@index');
            Route::get('', [StoreController::class, 'index'])->name('index');
            Route::get('/create', [StoreController::class, 'create'])->name('create');
            Route::post('/store', [StoreController::class, 'store'])->name('store');
            Route::get('/{store}/edit', [StoreController::class, 'edit'])->name('edit');
            Route::put('/update/{store}', [StoreController::class, 'update'])->name('update');
            Route::delete('/destroy/{store}', [StoreController::class, 'destroy'])->name('destroy');
        });
    
        // Route::resource('products', ProductController::class);
    
        Route::prefix('products')->name('products.')->group(function() {
            Route::get('', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
        });
    
        Route::prefix('categories')->name('categories.')->group(function() {
            Route::get('', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        });

        Route::post('photos/remove', [ProductPhotoController::class, 'removePhoto'])->name('photo.remove');
    
    });

});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
