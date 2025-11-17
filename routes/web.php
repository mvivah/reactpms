<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    // Categories Routes
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::get('/list', [CategoryController::class, 'list'])->name('list');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // Brands Routes
    Route::prefix('brands')->name('brands.')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/store', [BrandController::class, 'store'])->name('store');
        Route::get('/edit/{brand}', [BrandController::class, 'edit'])->name('edit');
        Route::get('/list', [BrandController::class, 'list'])->name('list');
        Route::put('/update/{brand}', [BrandController::class, 'update'])->name('update');
        Route::delete('/delete/{brand}', [BrandController::class, 'destroy'])->name('destroy');
    });

    // Suppliers Routes
    Route::prefix('suppliers')->name('suppliers.')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index');
        Route::get('/create', [SupplierController::class, 'create'])->name('create');
        Route::post('/store', [SupplierController::class, 'store'])->name('store');
        Route::get('/edit/{supplier}', [SupplierController::class, 'edit'])->name('edit');
        Route::get('/list', [SupplierController::class, 'list'])->name('list');
        Route::post('/update-status', [SupplierController::class, 'updateActiveStatus'])->name('toggle-status');
        Route::delete('/delete/{supplier}', [SupplierController::class, 'destroy'])->name('destroy');
    });

    // Units Routes
    Route::prefix('units')->name('units.')->group(function () {
        Route::get('/', [UnitController::class, 'index'])->name('index');
        Route::get('/create', [UnitController::class, 'create'])->name('create');
        Route::post('/store', [UnitController::class, 'store'])->name('store');
        Route::get('/edit/{unit}', [UnitController::class, 'edit'])->name('edit');
        Route::get('/list', [UnitController::class, 'list'])->name('list');
        Route::delete('/delete/{unit}', [UnitController::class, 'destroy'])->name('destroy');
    });

    // Products Routes
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::get('/show/{product}', [ProductController::class, 'show'])->name('show');
        Route::get('/select/{product}', [ProductController::class, 'select'])->name('select');
        Route::get('/list/{extraParam?}', [ProductController::class, 'list'])->name('list');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('destroy');
        Route::get('/eoq_report', [ProductController::class, 'eoqReport'])->name('eoq_report');
        Route::post('/generate', [ProductController::class, 'generate'])->name('generate');
        Route::get('/expired_report', [ProductController::class, 'expiredReport'])->name('expired_report');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
