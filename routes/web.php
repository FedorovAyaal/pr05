<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\StorePostController;
use App\Http\Controllers\Post\SearchController;
use App\Http\Controllers\Post\ShowPostController;
use App\Http\Controllers\Post\StoreCommentController;
use App\Http\Controllers\Post\PostUpdateController;
use App\Http\Controllers\Post\PostDeleteController;
use App\Http\Controllers\Post\UpdateCommentController;


use App\Http\Controllers\Post\StoreUpdatePostController;
use App\Http\Controllers\Post\DeleteCommentController;
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
Route::get('category/{id}', CategoryController::class)->name('post.by_category');
Route::get('post/', SearchController::class)->name('post.by_search');
//Действия для администратора
Route::group(['middleware' => ['auth', 'admin']], function () {
    //Добавление новости
    Route::get('/create/post', PostController::class)->name('post.create');
    Route::post('/create/post', StorePostController::class)->name('post.store');
    //TODO:Редактирование новости
    Route::get('/update/post/{post}', PostUpdateController::class)->name('post.update');
    Route::patch('/update/post/{post}', StoreUpdatePostController::class)->name('post.store_update');
    //Удаление новости
    Route::delete('/delete/post/{post}', PostDeleteController::class)->name('post.delete');
});

//Действия для всех авторизованных пользователей
Route::group(['middleware' => ['auth']], function () {
    Route::post('/create/comment/{post_id}', StoreCommentController::class)->name('post.store_comment');
    Route::delete('/delete/comment/{comment}', DeleteCommentController::class)->name('post.delete_comment');
    Route::patch('/update/comment/{comment}', UpdateCommentController::class)->name('post.comment_update');
});
