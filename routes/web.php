<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::middleware('role:admin')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
        Route::get('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories');
        Route::post('/category', [\App\Http\Controllers\Admin\CategoryController::class, 'store']);
        Route::delete('/category/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy']);
        Route::put('/category/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'update']);
    });
});
