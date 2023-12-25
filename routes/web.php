<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\UserController;
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
    Route::get('/', [BlogController::class, 'getListBlog'])->name('home');
    Route::get('/register', [AuthController::class, 'register'])->name('register.index');
    Route::post('/register', [AuthController::class, 'registerUser'])->name('register');
    Route::get('/verified/{register}/{token}', [AuthController::class, 'verified'])->name('register.verified');
    Route::get('/login', [AuthController::class, 'login'])->name('login.index');
    Route::post('/login', [AuthController::class, 'loginUser'])->name('login');
    Route::get('/blog/detail/{id}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/reset-password-form', [AuthController::class, 'resetForm'])->name('reset.index');
    Route::post('/send-reset-password', [AuthController::class, 'sendResetPassword'])->name('reset.send');
    Route::get('/reset/{token}', [AuthController::class, 'mailResetPassword'])->name('reset.mail');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');
    Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout');

    Route::group(['middleware' => 'auth_admin'], function () {
        //Admin
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin.index');
            Route::get('/users', [AdminController::class, 'users'])->name('user-list');
            Route::put('/toggle-block/{id}', [AdminController::class, 'blockUser'])->name('toggle-block');
            Route::get('/blogs', [AdminController::class, 'blogs'])->name('blog-list');
            Route::get('/edit/blog/{id}', [AdminController::class, 'edit'])->name('blog-edit');
            Route::put('/update/blog/{id}', [AdminController::class, 'update'])->name('blog-update');
            Route::delete('/delete/blog/{id}', [AdminController::class, 'destroy'])->name('blog-delete');
            Route::put('/toggle-approved/{id}', [AdminController::class, 'approvedBlog'])->name('toggle-approved');
        });
    });

    Route::group(['middleware' => 'auth_user'], function () {
        Route::get('/resend-mail-verify', [AuthController::class, 'resendMailVerify'])->name('resend-mail-verify');
        Route::post('/resend', [AuthController::class, 'resendMail'])->name('resend');

        //User
        Route::post('/like-blog', [UserController::class, 'likeBlog'])->name('like.blog');
        Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('profile.update');
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('change.password');
        Route::put('/change-password/{id}', [UserController::class, 'updatePassword'])->name('update.password');

        //blog
        Route::group(['prefix' => 'blog'], function () {
            Route::get('/', [BlogController::class, 'index'])->name('blog.index');
            Route::post('/create', [BlogController::class, 'create'])->name('blog.create');
            Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
            Route::put('/update/{id}', [BlogController::class, 'update'])->name('blog.update');
            Route::delete('/delete/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
        });

        // comment
        Route::group(['prefix' => 'comment'], function () {
            Route::post('/create', [CommentController::class, 'create'])->name('comment.create');
            Route::put('/update/{id}', [CommentController::class, 'update'])->name('comment.update');
            Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
        });
    });
});
