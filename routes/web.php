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

Route::get('/question', function () {
    return view('admin/questions/question');
})->name('question');

# ADMIN
Route::group(['prefix' => 'auth'], function () {
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

        Route::group(['prefix' => 'countries'], function () {
            Route::get('/', [App\Http\Controllers\Admin\CountryController::class, 'index'])->name('countries.index');
            Route::post('/json', [App\Http\Controllers\Admin\CountryController::class, 'json'])->name('countries.json');
            Route::post('/show', [App\Http\Controllers\Admin\CountryController::class, 'show'])->name('countries.show');
            Route::post('/save', [App\Http\Controllers\Admin\CountryController::class, 'save'])->name('countries.save');
        });

        Route::group(['prefix' => 'provinces'], function () {
            Route::get('/', [App\Http\Controllers\Admin\ProvinceController::class, 'index'])->name('provinces.index');
            Route::post('/json', [App\Http\Controllers\Admin\ProvinceController::class, 'json'])->name('provinces.json');
            Route::post('/show', [App\Http\Controllers\Admin\ProvinceController::class, 'show'])->name('provinces.show');
            Route::post('/save', [App\Http\Controllers\Admin\ProvinceController::class, 'save'])->name('provinces.save');
        });

        Route::group(['prefix' => 'pasiens'], function () {
            Route::get('/', [App\Http\Controllers\Admin\PasienController::class, 'index'])->name('pasiens.index');
            Route::post('/json', [App\Http\Controllers\Admin\PasienController::class, 'json'])->name('pasiens.json');
            Route::post('/show', [App\Http\Controllers\Admin\PasienController::class, 'show'])->name('pasiens.show');
        });
    });

    Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('sign.out');
    Route::group(['middleware' => 'throttle:5,1'], function () {
        Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('sign.in');
    });
});
