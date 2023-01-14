<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\HomeController;

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

// Logged Routes
Route::middleware('auth')->prefix('dashboard')->as('dashboard.')->group(function () {

    // Home Route
    Route::controller(HomeController::class)->prefix('/')->as('home')->group(function () {
        Route::get('/', 'index');
    });

    // Posts Route
    Route::controller(PostController::class)->prefix('posts')->as('posts.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('trashed', 'trashed')->name('trashed');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{post_id}', 'edit')->name('edit')->whereNumber('post_id');
        Route::post('update/{post_id}', 'update')->name('update')->whereNumber('post_id');
        Route::post('delete/{post_id}', 'destroy')->name('delete')->whereNumber('post_id');
    });

    // Comments Route
    Route::controller(CommentController::class)->prefix('comments')->as('comments.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{comment_id}', 'edit')->name('edit')->whereNumber('comment_id');
        Route::post('update/{comment_id}', 'update')->name('update')->whereNumber('comment_id');
        Route::post('delete/{comment_id}', 'destroy')->name('delete')->whereNumber('comment_id');
    });

});

