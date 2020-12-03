<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;


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




Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware(['auth']); // fortify auth middleware
    Route::resource('products', ProductController::class)->middleware(['auth']);
    // Route::resource('customers', CustomerController::class)->middleware(['auth']);
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index')->middleware(['auth']);
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create')->middleware(['auth']);
    Route::post('customers/store', [CustomerController::class, 'store'])->name('customers.store')->middleware(['auth']);
    Route::get('customers/{param}/edit', [CustomerController::class, 'edit'])->name('customers.edit')->middleware(['auth']);
    Route::DELETE('customers/destroy/{param}', [CustomerController::class, 'destroy'])->name('customers.destroy')->middleware(['auth']);
    Route::get('customers/list', [CustomerController::class, 'getCustomers'])->name('customers.list')->middleware(['auth']);
});