<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\User\PostController as UserPostController;
use App\Http\Controllers\User\CommentController as UserCommentController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Admin Auth
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('admin.logout');

//user register
Route::post('/register', [AuthController::class, 'register'])->name('register');

// User Auth
Route::post('/user/login', [AuthController::class, 'userLogin'])->name('user.login');
Route::post('/user/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('user.logout');


/*
|--------------------------------------------------------------------------
| Admin Panel (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Posts Management
    Route::resource('posts', AdminPostController::class);

    // Comments Management
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('/index', [AdminCommentController::class, 'index'])->name('index');
        Route::put('/{comment}/approve', [AdminCommentController::class, 'approve'])->name('approve');
        Route::put('/{comment}/reject', [AdminCommentController::class, 'reject'])->name('reject');
    });
});


/*
|--------------------------------------------------------------------------
| User Side (Public + Protected)
|--------------------------------------------------------------------------
*/

// Public user routes
Route::get('user/posts', [UserPostController::class, 'index'])->name('user.posts.index');

// Protected user routes
Route::middleware(['auth:sanctum'])->prefix('user')->name('user.')->group(function () {
    Route::post('posts/{post}/comments', [UserCommentController::class, 'store'])->name('comments.store');
});


/*
|--------------------------------------------------------------------------
| Misc Test Routes
|--------------------------------------------------------------------------
*/
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// it's just for testing
Route::get('hello', function () {
    return 'hello';
})->name('hello');
