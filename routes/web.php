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

Route::group(['middleware' => ['auth']], function () {
    Route::patch('/edit-profile', 'UserController@editProfile')->name('edit-profile');

    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('products', 'ProductController');
    Route::resource('photos', 'PhotoController');
    Route::get('new-feed', 'RelaxController@index')->name('new-feed');
    Route::get('chats', function ()
    {
        return view('messages.private-chat');
    });

    Route::get('messages', 'MessageController@fetchMessages');
    Route::post('messages', 'MessageController@sendMessages');
    Route::get('fetchUsers', 'MessageController@fetchUsers');
    Route::get('/private-messages/{user}', 'MessageController@privateMessages')->name('privateMessages');
    Route::post('/private-messages/{user}', 'MessageController@sendPrivateMessage')->name('privateMessages.store');
});

// user profile
Route::group(['middleware' => 'auth', 'prefix' => 'profile'], function () {
    Route::get('/', 'ProfileController@index')->name('profile.index');
    Route::get('/photos', 'ProfileController@getPhotos')->name('profile.photos'); 
    Route::post('/photos', 'ProfileController@store')->name('profile.photo.store'); 
    Route::patch('/photos/{id}', 'ProfileController@update')->name('profile.photo.update'); 
    Route::delete('/photos/{id}', 'ProfileController@destroy')->name('profile.photo.destroy'); 
});
