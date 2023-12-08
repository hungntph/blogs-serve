<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\BlogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'user'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register.index');
    Route::post('/register', [AuthController::class, 'registerUser'])->name('register');
    Route::get('/verified/{register}/{token}', [AuthController::class, 'verified'])->name('register.verified');
    Route::get('/login', [AuthController::class, 'login'])->name('login.index');
    Route::post('/login', [AuthController::class, 'loginUser'])->name('login');

    Route::group(['middleware' => 'auth_user'], function () {
        Route::get('/', [AuthController::class, 'home'])->name('home');
        Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout');
        Route::get('/resend-mail-verify', [AuthController::class, 'resendMailVerify'])->name('resend-mail-verify');
        Route::post('/resend', [AuthController::class, 'resendMail'])->name('resend');

        //blog
        Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
        Route::post('/blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    });
});
