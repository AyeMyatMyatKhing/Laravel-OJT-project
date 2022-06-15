<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChangePasswordController;


Route::resource('/posts', 'App\Http\Controllers\PostController');
Route::get('/postlist' , [PostController::class ,'index']);
Route::get('posts/create', [PostController::class, 'create']);
Route::get('posts/create/collectDataForm', [PostController::class, 'collectDataForm']);
Route::post('posts/store/collectdata', [PostController::class, 'storeCollectData'])->name('posts.store');
Route::get('posts/update/updateCollectData', [PostController::class, 'updateCollectData']);
Route::put('posts/update/updateConfirm/{id}' , [PostController::class, 'updatePost']);
Route::get('/', [PostController::class, 'guestPost']);
Route::get('/search_posts', [PostController::class, 'search']);
Route::get('posts/showdetail/{id}' , [PostController::class , 'show'])->name('postdetail');
Route::post('/uploadpost' , [PostController::class , 'uploadFile']);
Route::get('/downloadpost' , [PostController::class , 'exportFile']);

Route::resource('/users' , 'App\Http\Controllers\UserController');
Route::get('users/create', [UserController::class, 'create']);
Route::get('users/create/collectdataform' , [UserController::class, 'collectDataForm']);
Route::post('users/store/collectdata', [UserController::class, 'storeCollectData']);
Route::get('/search_user' , [UserController::class, 'search']);
Route::get('users/edit/{id}' , [UserController::class, 'edit']);
Route::get('users/update/collectData', [UserController::class, 'collectData']);
Route::put('users/update/updateConfirm/{id}', [UserController::class, 'updateUser']);
Route::get('/userprofile/{id}' , [UserController::class, 'userProfile']);

Auth::routes();

Route::group(['middleware'=>'auth'] , function(){
    Route::get('/changepassword' , [ChangePasswordController::class , 'changePasswordForm'])->name('changepassword');
    Route::post('/changepassword' , [ChangePasswordController::class , 'changePassword']); 
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
