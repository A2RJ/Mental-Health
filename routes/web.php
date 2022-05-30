<?php

use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\QuestionCategoryController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
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
Route::get('/', [PageController::class, 'index'])->name('page.index');
Route::post('/', [PageController::class, 'save'])->name('page.save');

# ADMIN
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [LoginController::class, 'showLoginFormAdmin'])->name('admin.login');
    Route::get('/', function () {
        return redirect()->route('admin.index');
    });

    Route::group(['middleware' => ['auth', 'role:Super Admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');

        Route::group(['prefix' => 'question-category'], function () {
            Route::get('/', [QuestionCategoryController::class, 'index'])->name('question-category.index');
            Route::post('/', [QuestionCategoryController::class, 'store'])->name('question-category.store');
            Route::put('/{questionCategory}', [QuestionCategoryController::class, 'update'])->name('question-category.update');
            Route::delete('/{questionCategory}', [QuestionCategoryController::class, 'destroy'])->name('question-category.destroy');
        });

        Route::group(['prefix' => 'question'], function () {
            Route::get('/create', [QuestionController::class, 'create'])->name('question.create');
            Route::get('/{question}', [QuestionController::class, 'index'])->name('question.index');
            Route::post('/', [QuestionController::class, 'store'])->name('question.store');
            Route::put('/{question}', [QuestionController::class, 'update'])->name('question.update');
            Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
        });

        Route::group(['prefix' => 'location'], function () {
            Route::get('/', [LocationController::class, 'index'])->name('location.index');
            Route::post('/json', [LocationController::class, 'json'])->name('location.json');
            Route::post('/show', [LocationController::class, 'show'])->name('location.show');
            Route::post('/save', [LocationController::class, 'save'])->name('location.save');
            Route::post('/delete', [LocationController::class, 'delete'])->name('location.delete');
        });

        Route::group(['prefix' => 'countries'], function () {
            Route::get('/', [CountryController::class, 'index'])->name('countries.index');
            Route::post('/json', [CountryController::class, 'json'])->name('countries.json');
            Route::post('/show', [CountryController::class, 'show'])->name('countries.show');
            Route::post('/save', [CountryController::class, 'save'])->name('countries.save');
        });

        Route::group(['prefix' => 'provinces'], function () {
            Route::get('/', [ProvinceController::class, 'index'])->name('provinces.index');
            Route::post('/json', [ProvinceController::class, 'json'])->name('provinces.json');
            Route::post('/show', [ProvinceController::class, 'show'])->name('provinces.show');
            Route::post('/save', [ProvinceController::class, 'save'])->name('provinces.save');
        });

        Route::group(['prefix' => 'pasiens'], function () {
            Route::get('/', [PasienController::class, 'index'])->name('pasiens.index');
            Route::post('/json', [PasienController::class, 'json'])->name('pasiens.json');
            Route::post('/show', [PasienController::class, 'show'])->name('pasiens.show');
        });
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('sign.out');
    Route::group(['middleware' => 'throttle:5,1'], function () {
        Route::post('login', [LoginController::class, 'login'])->name('sign.in');
    });
});
