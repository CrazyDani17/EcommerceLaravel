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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'Ecommerce\FrontController@index')->name('front.index');
Route::get('/product', 'Ecommerce\FrontController@product')->name('front.product');
Route::get('/category/{slug}', 'Ecommerce\FrontController@categoryProduct')->name('front.category');
Route::get('/product/{slug}', 'Ecommerce\FrontController@show')->name('front.show_product');
Route::post('cart', 'Ecommerce\CartController@addToCart')->name('front.cart');
Route::get('/cart', 'Ecommerce\CartController@listCart')->name('front.list_cart');
Route::post('/cart/update', 'Ecommerce\CartController@updateCart')->name('front.update_cart');
Route::get('/checkout', 'Ecommerce\CartController@checkout')->name('front.checkout');
Route::get('/checkout/{invoice}', 'Ecommerce\CartController@checkoutFinish')->name('front.finish_checkout');
Route::post('/paypal/pay', 'PaymentController@payWithPayPal')->name('pay_with_paypal');
Route::get('/paypal/status', 'PaymentController@payPalStatus');
Route::get('search','Ecommerce\FrontController@search')->name('front.search');
Route::post('search','Ecommerce\FrontController@search_with_button')->name('front.search_with_button');


Auth::routes();

Route::group(['prefix' => 'courier', 'namespace' => 'Courier'], function() {
    
    Route::get('login', 'LoginController@loginForm')->name('courier.login');
    Route::get('register', 'LoginController@registerForm')->name('courier.register');
	Route::post('login', 'LoginController@login')->name('courier.post_login');
    Route::post('regiter', 'LoginController@register')->name('courier.post_register');
    Route::get('verify/{token}', 'LoginController@verifyCustomerRegistration')->name('courier.verify');

    Route::group(['middleware' => 'courier'], function() {
        Route::get('/home', 'HomeController@index')->name('courier.home');
        Route::get('order', 'OrderController@index')->name('courier.orders');
        Route::get('order/update_status/{id}','OrderController@update_status')->name('courier.update_order_status');
        Route::put('order/change_status/{id}','OrderController@change_status')->name('courier.change_order_status');
        Route::resource('delivery_guy', 'Delivery_guyController')->except(['show']);
    });
});


Route::group(['prefix' => 'delivery_guy', 'namespace' => 'Delivery_guy'], function() {
    
    Route::get('login', 'LoginController@loginForm')->name('delivery_guy.login');
    Route::get('register', 'LoginController@registerForm')->name('delivery_guy.register');
	Route::post('login', 'LoginController@login')->name('delivery_guy.post_login');
    Route::post('regiter', 'LoginController@register')->name('delivery_guy.post_register');
    Route::get('verify/{token}', 'LoginController@verifyCustomerRegistration')->name('delivery_guy.verify');

    Route::group(['middleware' => 'delivery_guy'], function() {
        Route::get('/home', 'HomeController@index')->name('delivery_guy.home');
        Route::get('order', 'OrderController@index')->name('delivery_guy.orders');
        Route::put('order/change_status_on_the_way/{id}','OrderController@change_status_on_the_way')->name('delivery.change_status_on_the_way');
        Route::put('order/change_status_ready/{id}','OrderController@change_status_ready_for_pick_up')->name('delivery.change_status_ready_for_pick_up');
    });
});

Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('category', 'CategoryController')->except(['create', 'show']);
    Route::get('category/listing', 'CategoryController@listing')->name('category.listing');
    Route::resource('product', 'ProductController')->except(['show']);
    Route::resource('customer', 'CustomerController')->except(['show']);
    Route::resource('order', 'OrderController')->except(['show']);
    Route::resource('courier', 'CourierController')->except(['show']);
    Route::get('product/trending', 'ProductController@trending')->name('product.trending');
});

Route::group(['prefix' => 'member', 'namespace' => 'Ecommerce'], function() {
	Route::get('login', 'LoginController@loginForm')->name('customer.login');
    Route::get('register', 'LoginController@registerForm')->name('customer.register');
	Route::post('login', 'LoginController@login')->name('customer.post_login');
    Route::post('regiter', 'LoginController@register')->name('customer.post_register');
    Route::get('verify/{token}', 'FrontController@verifyCustomerRegistration')->name('customer.verify');

    Route::group(['middleware' => 'customer'], function() {
	    Route::get('dashboard', 'LoginController@dashboard')->name('customer.dashboard');
	    Route::get('logout', 'LoginController@logout')->name('customer.logout'); //TAMBAHKAN BARIS INI
        Route::get('favorites','FrontController@favorites')->name('customer.favorites');
        Route::get('orders','FrontController@orders')->name('customer.orders');
        Route::put('delivery_received/{id}','FrontController@delivery_received')->name('customer.delivery_received');
        Route::get('edit_profile', 'LoginController@edit_profile')->name('customer.edit_form');
        Route::post('edit', 'LoginController@edit_customer')->name('customer.post_edit');
        Route::delete('destroy_account', 'LoginController@destroy_account')->name('customer.destroy_account');
        Route::get('restore_pass', 'LoginController@restore_pass')->name('customer.restore_pass_form');
        Route::post('post_restore_pass', 'LoginController@restore_password')->name('customer.post_retore_password');
	});
});