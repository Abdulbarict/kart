<?php

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

Route::get('/welcome', function () {
    return view('welcome');
});
// Route::get('/{slug}', function($slug){
    

Route::get('/','HomeController@frontIndex');
// });


Route::group(['prefix'=>'account'],function(){
    Auth::routes();
});
Route::group(['middleware' => 'auth','prefix'=>'account'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('products','ProductController');
    Route::resource('profile','UserController')->only([
    'edit', 'update']);
    Route::resource('categories','CategoryController');
    Route::resource('users','UserController');

    Route::group(['prefix' => 'api'], function() {
        Route::get('categories','CategoryController@ApiList')->name('categoriesapi');
        Route::post('users','UserController@updateAppStatus')->name('usersapi');
        
    });
});
