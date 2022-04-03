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

Route::resource('catalog', 'CatalogController')->parameters(['catalog' => 'slug']);

Route::prefix('cart')->group(function() {
    Route::get('', 'CartController@index')->name('cart.index');
    Route::patch('update', 'CartController@update')->name('cart.update');
    Route::get('destroy', 'CartController@destroy')->name('cart.destroy');
    Route::get('checkout', 'CartController@checkout')->name('cart.checkout');
    Route::get('add/{productId}', 'CartController@add')->name('cart.add');
    Route::get('drop', 'CartController@drop')->name('cart.drop');
    Route::get('checkout/success', 'CartController@checkoutSuccess')->name('cart.checkout.success');
});

Route::resource('order', 'OrderController', ['only' => ['store', 'update', 'destroy', 'show']]);

// Admin routes
Route::group(['prefix' => 'admin-panel', 'middleware' => 'auth', 'adminPanel'], function() {
    Route::get('/', AdminController::class)->name('admin.index');

    // Users
    Route::prefix('users')->group(function () {
        Route::get('/', 'AdminUserController@index')->name('admin.users.index');
        Route::get('edit/{user}', 'AdminUserController@edit')->name('admin.users.edit');
        Route::put('edit/{user}', 'AdminUserController@update')->name('admin.users.update');
        Route::get('delete/{user}', 'AdminUserController@delete')->name('admin.users.delete');
    });

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductController@index')->name('admin.products.index');
        Route::get('create', 'ProductController@create')->name('admin.products.create');
        Route::post('create', 'ProductController@store')->name('admin.products.store');
        Route::get('edit/{product}', 'ProductController@edit')->name('admin.products.edit');
        Route::put('edit/{product}', 'ProductController@update')->name('admin.products.update');
        Route::get('delete/{product}', 'ProductController@delete')->name('admin.products.delete');
        Route::get('drop/{id}', 'ProductController@destroy')->name('admin.products.destroy');
        Route::get('restore/{id}', 'ProductController@restore')->name('admin.products.restore');
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', 'OrderController@index')->name('admin.orders.index');
        Route::get('show/{id}', 'OrdersController@show')->name('admin.orders.show');
        Route::get('delete/{id}', 'OrderController@delete')->name('admin.orders.delete');
    });
});
