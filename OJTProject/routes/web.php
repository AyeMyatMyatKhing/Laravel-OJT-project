<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::resource('/posts', 'App\Http\Controllers\PostController');
Route::get('/', [PostController::class,'index']);
Route::get('posts/create', [PostController::class, 'create']);
Route::get('posts/create/collectDataForm', [PostController::class, 'collectDataForm']);
Route::post('posts/store/collectdata', [PostController::class, 'storeCollectData'])->name('posts.store');
Route::get('/search_posts', [PostController::class, 'search']);
Route::get('posts/update/updateCollectData', [PostController::class, 'updateCollectData']);
Route::put('posts/update/updateConfirm/{id}' , [PostController::class, 'updatePost']);

Route::resource('/users' , 'App\Http\Controllers\UserController');
Route::get('users/create', [UserController::class, 'create']);
Route::get('users/create/collectdataform' , [UserController::class, 'collectDataForm']);
Route::post('users/store/collectdata', [UserController::class, 'storeCollectData']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
