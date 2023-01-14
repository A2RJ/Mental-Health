<?php

use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\QuestionCategoryController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SuggestionController;
use App\Http\Controllers\SurveyController;
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
// Route::get('/', [PageController::class, 'index'])->name('page.index');
// Route::post('/', [PageController::class, 'save'])->name('page.save');

Route::get('/', [SurveyController::class, 'index'])->name('page.index');
Route::get('/getquestion/{category}', [SurveyController::class, 'question'])->name('getquestion');
Route::get('/start/{category}', [SurveyController::class, 'start'])->name('start');
Route::post('/store', [SurveyController::class, 'store'])->name('survey.store');
Route::get('/result/{id}', [SurveyController::class, 'result']);
// send mail route
Route::post('/sendmail', [SurveyController::class, 'sendmail'])->name('sendmail');

# ADMIN
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [LoginController::class, 'showLoginFormAdmin'])->name('admin.login');
    Route::get('/', function () {
        return redirect()->route('admin.index');
    });

    Route::group(['middleware' => ['auth', 'role:Super Admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');
        Route::post('/social-media', [DashboardController::class, 'socialMedia'])->name('admin.social-media');

        Route::group(['prefix' => 'question-category'], function () {
            Route::get('/', [QuestionCategoryController::class, 'index'])->name('question-category.index');
            Route::post('/', [QuestionCategoryController::class, 'store'])->name('question-category.store');
            Route::put('/{questionCategory}', [QuestionCategoryController::class, 'update'])->name('question-category.update');
            Route::delete('/{questionCategory}', [QuestionCategoryController::class, 'destroy'])->name('question-category.destroy');
        });

        Route::group(['prefix' => 'question'], function () {
            Route::get('/{question}', [QuestionController::class, 'index'])->name('question.index');
            Route::get('/create/{question}', [QuestionController::class, 'create'])->name('question.create');
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
            Route::post('/delete/{prov_id}', [ProvinceController::class, 'destroy'])->name('provinces.delete');
        });

        // suggestion
        Route::group(['prefix' => 'suggestion'], function () {
            Route::get('/json', [SuggestionController::class, 'json'])->name('suggestion.json');
            Route::get('/', [SuggestionController::class, 'index'])->name('suggestion.index');
            Route::get('/create', [SuggestionController::class, 'create'])->name('suggestion.create');
            Route::post('/', [SuggestionController::class, 'store'])->name('suggestion.store');
            Route::put('/{suggestion}', [SuggestionController::class, 'update'])->name('suggestion.update');
            Route::delete('/{suggestion}', [SuggestionController::class, 'destroy'])->name('suggestion.destroy');

            Route::get('/import', [SuggestionController::class, 'insertSuggestion'])->name('suggestion.import');
            Route::delete('/', [SuggestionController::class, 'drop'])->name('suggestion.drop');
        });

        Route::group(['prefix' => 'pasiens'], function () {
            Route::get('/', [PasienController::class, 'index'])->name('pasiens.index');
            Route::get('/export', [PasienController::class, 'export'])->name('pasiens.export');
            Route::post('/json', [PasienController::class, 'json'])->name('pasiens.json');
            Route::post('/show', [PasienController::class, 'show'])->name('pasiens.show');
            Route::delete('/delete/{pasiens}', [PasienController::class, 'destroy'])->name('pasiens.delete');
        });
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('sign.out');
    Route::group(['middleware' => 'throttle:5,1'], function () {
        Route::post('login', [LoginController::class, 'login'])->name('sign.in');
    });
});
