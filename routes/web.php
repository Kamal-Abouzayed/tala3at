<?php

use App\Http\Controllers\dashboard\auth\LoginController;
use App\Http\Controllers\dashboard\auth\RegisterController;
use App\Http\Controllers\dashboard\CitiesController;
use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\ProfileController;
use App\Http\Controllers\dashboard\StoryController;
use App\Http\Controllers\dashboard\UserController;
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

Route::get('/', function(){
    if (auth()->check() && auth()->user()->is_admin != 1) {
        auth()->logout();
        return redirect(route('login'));
    }else{
        return redirect(route('dashboard'));
    }
});


// Auth Routes
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login-submit');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    /* Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit'); */
});




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin'
    ], function () {
        Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::get('cities', [StoryController::class, 'getCityList'])->name('cityList');
        Route::resource('stories', StoryController::class);
        Route::get('profile/{id}', [ProfileController::class, 'showProfile'])->name('profile');
    });
});
