<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/store',function()
{
    return view('store.index');
});
Route::get('/login',function()
{
    return view('store.login');
});
Route::get('/register',function()
{
    return view('store.register');
});
Route::post('/register','store@add');
Route::post('/login','store@login');

Route::get('/connect','CPS@connect');

Route::get('/', function () {
    return view('welcome');
});

// CUSTOMER
Route::post('/api/customer/login', 'CustomerAPIController@login');
Route::get('/api/customer/orders/recent', 'CustomerAPIController@recentOrders');
Route::get('/api/customer/stores', 'CustomerAPIController@stores');
Route::post('/orders', 'CustomerAPIController@orders');
Route::put('/orders/{id}', 'CustomerAPIController@updateOrderStatus');

// DELIVERY
Route::post('/login/driver', 'DeliveryAPIController@login');
Route::get('/orders', 'DeliveryAPIController@orders');
Route::put('/orders/{id}', 'DeliveryAPIController@updateOrderStatus');
