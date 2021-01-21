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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Admin login routes
Route::get('/admin-login', 'LoginController@index');
Route::post('/check-login', 'LoginController@check_login');
Route::get('/admin-logout', 'LoginController@admin_logout');
Route::get('/generate-hash/{text}', 'LoginController@generate_hash');

Route::group(['middleware' => ['checkAdminSession']], function () {

	Route::get('/admin-dashboard', 'AdminController@index');

	//Add Categories routes
	Route::get('/add-categories', 'AdminController@add_categories');
	Route::post('/validate-add-categories', 'AdminController@validate_add_categories');


	//Add Products routes
	Route::get('/add-products', 'AdminController@add_products');
	Route::post('/validate-add-products', 'AdminController@validate_add_products');


	//Orders routes
	Route::get('/order-list', 'AdminController@order_list');


});


//User Login Routes
Route::get('/user-login', 'LoginController@user_index');
Route::post('/check-login-user', 'LoginController@check_login_user');
Route::get('/user-logout', 'LoginController@user_logout');

Route::get('/user-register', 'UserController@user_register');
Route::post('/validate-user-register', 'UserController@validate_user_register');

Route::group(['middleware' => ['checkUserSession']], function () {

	Route::get('/user-dashboard', 'UserController@index');
	Route::post('/add-to-cart', 'UserController@add_to_cart');

	Route::get('/cart', 'UserController@cart');
	Route::post('/remove-from-cart', 'UserController@remove_from_cart');
	Route::post('/place-order', 'UserController@place_order');

});