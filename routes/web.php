<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

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
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::get('/categories', [AdminCategoryController::class, 'getCategories'])->name('categories');
        Route::get('/category', [AdminCategoryController::class, 'index'])->name('category');
        Route::post('/category', [AdminCategoryController::class, 'store']);
        Route::delete('/category/{id}', [AdminCategoryController::class, 'destroy']);
        Route::put('/category/{id}', [AdminCategoryController::class, 'update']);

        Route::get('/account', [AdminAccountController::class, 'profile'])->name('edit_profile');
        Route::get('/account/password', [AdminAccountController::class, 'password'])->name('edit_password');
        Route::put('/account/update_profile', [AdminAccountController::class, 'updateProfile'])->name('update_profile');
        Route::put('/account/update_password', [AdminAccountController::class, 'updatePassword'])->name('update_password');

        Route::get('/tags', [AdminTagController::class, 'getTags'])->name('tags');
        Route::get('/tag', [AdminTagController::class, 'index'])->name('tag');
        Route::post('/tag', [AdminTagController::class, 'store']);
        Route::delete('/tag/{id}', [AdminTagController::class, 'destroy']);
        Route::put('/tag/{id}', [AdminTagController::class, 'update']);

        Route::resource('post', AdminPostController::class);
    });
});
