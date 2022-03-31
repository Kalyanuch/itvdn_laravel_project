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
/*
Route::get('/', function () {
    return view('welcome');
})->name('index');
*/
Route::get('/', 'PageController@index')->name('index');

Route::resource('test', 'TestController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/my_test', function(){ return 'Hello world! This is my test route :)'; });

//Route::get('/my_test/new/{id?}', function($id = 'default') { return 'Hello world! This is my test route with not required parameter. If you do not type parameter value function start using it\'s default value ID = ' . $id; });

//Route::get('/my_test/{id}', function($id) { return 'Hello world! This is my test route with parameter ID = ' . $id; });

Route::group(['prefix' => 'my_test'], function() {
    Route::get('', function() {
        return 'Hello world! This is my test route :)';
    });

    Route::get('new/{id?}', function($id = 'default') {
        return 'Hello world! This is my test route with not required parameter. If you do not type parameter value function start using it\'s default value ID = ' . $id;
    });

    Route::get('{id}', function($id) {
        return 'Hello world! This is my test route with parameter ID = ' . $id;
    });
});

Route::resource('users', 'UserController');

Route::resource('catalog', 'CatalogController');
