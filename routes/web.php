<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PublicController;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group that
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register')->middleware('guest');
    Route::post('/store', 'store')->name('store')->middleware('guest');
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/authenticate', 'authenticate')->name('authenticate')->middleware('guest');
    Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware('auth');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
    Route::get('/students', 'students')->name('students')->middleware('auth');
    Route::get('/university-api', 'university-api')->name('universityApi')->middleware('auth');   
    Route::get('/profile', 'profile')->name('profile')->middleware('auth');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('students', StudentController::class)->middleware('auth');


// Protected News routes
Route::middleware('auth')->group(function () {
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
    Route::post('/news/filter', [NewsController::class, 'filterNews'])->name('news.filter');
});

// Public News routes
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');


// Api


Route::get('/universities', [ApiController::class, 'index']);
Route::get('/api/universities', [ApiController::class, 'index'])->name('api.universities');

Route::get('/search-universities', [ApiController::class, 'search'])->name('search-universities');
Route::match(['get', 'post'], '/fetch-universities', [ApiController::class, 'fetchUniversities'])->name('fetch-universities');


Route::get('/active-news', [NewsController::class, 'showActiveNews'])->name('active.news');



Route::get('/', [PublicController::class, 'index'])->name('welcome');




