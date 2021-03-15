<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', [\App\Http\Controllers\BlogController::class, 'index']);

/*Route::get('/isi_post', function(){
	return view('blog.isi_post');
});*/
Route::get('/isi-post/{slug}', 'BlogController@isi_blog')->name('blog.isi');
Route::get('/list-post','BlogController@list_blog')->name('blog.list');
Route::get('/list-category/{category}','BlogController@list_category')->name('blog.category');
Route::get('/cari','BlogController@cari')->name('blog.cari');


Route::view('dashboard', 'dashboard')
	->name('dashboard')
	->middleware(['auth', 'verified']);

Route::view('dashboard', 'dashboard')
	->name('dashboard')
	->middleware(['auth', 'verified']);

Route::group(['prefix'=>'public'], function () {
    Route::get('/register', [\App\Http\Controllers\UserController::class, 'register_user_page'])->name('register.user');
    Route::post('/register/store', [\App\Http\Controllers\UserController::class, 'register_user_store'])->name('register.user.store');
});


Route::group(['middleware' => 'auth'], function() {
	Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index']);
	Route::get('/tag', [\App\Http\Controllers\TagsController::class, 'index']);

	Route::get('/post/tampil_hapus', [\App\Http\Controllers\PostController::class, 'tampil_hapus'])->name('post.tampil_hapus');
	Route::get('/post/restore/{id}', [\App\Http\Controllers\PostController::class, 'restore'])->name('post.restore');
	Route::delete('/post/kill/{id}', [\App\Http\Controllers\PostController::class, 'kill'])->name('post.kill');

	Route::get('/post', [\App\Http\Controllers\PostController::class]);
	Route::get('/user', [\App\Http\Controllers\UserController::class]);
});
