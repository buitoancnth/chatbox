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

Route::get('/', function () {
    return view('index');
});

Route::get('/index' ,'FirebaseController@index', function () {
    // return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::patch('/edit-profile', 'UserController@editProfile')->name('edit-profile');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('products', 'ProductController');
});

// user setting
Route::group(['middleware' => 'auth', 'prefix' => 'setting'], function () {
    Route::get('/', 'SettingController@index')->name('setting.index'); 
    // Route::patch('update', 'SettingController@update')->name('setting.update'); 
});
// Route::resource('users', 'UserController');
// Route::resource('roles', 'RoleController');
// Route::resource('products', 'ProductController');
