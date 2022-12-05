<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\StorePostController;
use App\Http\Controllers\Post\ShowPostController;

use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', IndexController::class)->name("home");
Route::get('/post/{slug}', ShowPostController::class)->name("post.show");
Route::group(['middleware' => ['auth', 'admin']], function () {
    //Добавление новости
    Route::get('/create/post', PostController::class)->name('post.create');
    Route::post('/create/post', StorePostController::class)->name('post.store');
    //TODO:Редактирование новости
    //Route::get('/update/post', PostController::class)->name('post.create');
    //Route::post('/update/post', StorePostController::class)->name('post.store');
});
