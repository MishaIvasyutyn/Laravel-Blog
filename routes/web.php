<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/article/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/tag/{slug}', [TagController::class, 'show'])->name('tag.show');
Route::get('/search', [PostController::class, 'search'])->name('search');

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'name' => 'admin.', 'as'=>'admin.'], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.home');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/posts', AdminPostController::class);
    Route::resource('/users', AdminUserController::class);
});

Route::group(['middleware' => 'guest'], function(){
    Route::match(['get', 'post'], '/register',[UserController::class, 'register'])->name('register');
    Route::match(['get', 'post'], '/login',[UserController::class, 'login'])->name('login');
});

Route::get('/logout',[UserController::class, 'logout'])->name('logout')->middleware('auth');
