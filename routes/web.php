<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCategoryController;
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

    Route::group(['middleware' => 'auth'], function () {
        //Auth
        Route::group(['prefix' => 'auth'], function () {
            Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout');
            Route::get('/resend-mail-verify', [AuthController::class, 'resendMailVerify'])->name('resend-mail-verify');
            Route::post('/resend', [AuthController::class, 'resendMail'])->name('resend');
            Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('profile.update');
            Route::get('/change-password', [UserController::class, 'changePassword'])->name('change.password');
            Route::put('/change-password/{id}', [UserController::class, 'updatePassword'])->name('update.password');
        });
    });

    Route::group(['middleware' => 'auth_admin'], function () {
        //Admin
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin.index');
            Route::get('/users', [AdminController::class, 'users'])->name('user-list');
            Route::put('/toggle-block/{id}', [AdminController::class, 'blockUser'])->name('toggle-block');

            //Admin blog
            Route::get('/blogs', [AdminBlogController::class, 'blogs'])->name('blog-list');
            Route::get('/edit/blog/{id}', [AdminBlogController::class, 'edit'])->name('blog-edit');
            Route::put('/update/blog/{id}', [AdminBlogController::class, 'update'])->name('blog-update');
            Route::delete('/delete/blog/{id}', [AdminBlogController::class, 'destroy'])->name('blog-delete');
            Route::put('/toggle-approved/{id}', [AdminBlogController::class, 'approvedBlog'])->name('toggle-approved');

            //Admin category
            Route::get('/categories', [AdminCategoryController::class, 'categories'])->name('category-list');
            Route::get('/category/create', [AdminCategoryController::class, 'index'])->name('category-index');
            Route::post('/category/create', [AdminCategoryController::class, 'create'])->name('category-create');
            Route::get('/edit/category/{id}', [AdminCategoryController::class, 'edit'])->name('category-edit');
            Route::put('/update/category/{id}', [AdminCategoryController::class, 'update'])->name('category-update');
            Route::delete('/delete/category/{id}', [AdminCategoryController::class, 'destroy'])->name('category-delete');
        });
    });

    Route::group(['middleware' => 'auth_user'], function () {
        //User
        Route::post('/like-blog', [UserController::class, 'likeBlog'])->name('like.blog');

        //blog
        Route::group(['prefix' => 'blog'], function () {
            Route::get('/', [BlogController::class, 'index'])->name('blog.index');
            Route::post('/create', [BlogController::class, 'create'])->name('blog.create');
            Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
            Route::put('/update/{id}', [BlogController::class, 'update'])->name('blog.update');
            Route::delete('/delete/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
            Route::get('/blogs', [BlogController::class, 'blogs'])->name('blogs-user');
        });

        // comment
        Route::group(['prefix' => 'comment'], function () {
            Route::post('/create', [CommentController::class, 'create'])->name('comment.create');
            Route::put('/update/{id}', [CommentController::class, 'update'])->name('comment.update');
            Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
        });
    });
});
