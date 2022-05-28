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

# PAGE
Route::get('/', [App\Http\Controllers\PageController::class, 'index'])->name('page.index');
Route::post('/', [App\Http\Controllers\PageController::class, 'save'])->name('page.save');

# ADMIN
Route::group(['prefix' => 'my-office'], function () {
    Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginFormAdmin'])->name('admin.login');
    Route::get('/', function() { return redirect()->route('admin.index'); });

    Route::group(['middleware' => ['auth', 'role:Super Admin']], function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.index');

        Route::group(['prefix' => 'location'], function () {
            Route::get('/', [App\Http\Controllers\Admin\LocationController::class, 'index'])->name('location.index');
            Route::post('/json', [App\Http\Controllers\Admin\LocationController::class, 'json'])->name('location.json');
            Route::post('/show', [App\Http\Controllers\Admin\LocationController::class, 'show'])->name('location.show');
            Route::post('/save', [App\Http\Controllers\Admin\LocationController::class, 'save'])->name('location.save');
            Route::post('/delete', [App\Http\Controllers\Admin\LocationController::class, 'delete'])->name('location.delete');
        });
    });

    Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('sign.out');
    Route::group(['middleware' => 'throttle:5,1'], function () {
        Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('sign.in');
    });
});