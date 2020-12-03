<?php

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

    // with fortify guest middleware
    // Route::get('foo', function () {
    //    return 'Foo';
    // })->middleware(['guest']);

    // with fortify auth middleware
    // Route::get('bar', function () {
    //    return 'bar';
    // }) ->middleware(['auth']);
    Route::get('/', [HomeController::class, 'index'])->middleware(['auth']);
    Route::get('/home', [HomeController::class, 'index'])->middleware(['auth']); // fortify auth middleware
    Route::resource('products', ProductController::class)->middleware(['auth']);
});