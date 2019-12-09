<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index');

/*
 * as:like naming route( admin.dashboard,admin.login etc)
 * prefix: admin will add in url (admin/dashboard,admin/login etc)
 * namespace: will add directory name (Admin\AdminController, Author\AuthorController etc)
 * auth: auth in middleware is default authentication in homeController
 * */
Route::group(['as'=>'admin.', 'prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth','checkAdmin']],function(){

    Route::get('/dashboard','AdminController@dashboard')->name('dashboard');
    Route::get('/post','PostController@showIndex')->name('post');
    Route::get('/post/create','PostController@create')->name('post.create');
    Route::post('/post/store','PostController@store')->name('post.store');

});


Route::group(['as'=>'author.', 'prefix'=>'author', 'namespace'=>'Author', 'middleware'=>['auth','checkAuthor']],function(){

    Route::get('/dashboard','AuthorController@dashboard')->name('dashboard');

});