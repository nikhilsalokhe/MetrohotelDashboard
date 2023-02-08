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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/Total_customer', 'Customer_info@Total_customer');
Route::get('/Todays_customer', 'Customer_info@Todays_customer');
Route::get('/Weeks_customer', 'Customer_info@Weeks_customer');
Route::get('/Months_customer', 'Customer_info@Months_customer');
Route::get('/MostVistited', 'Customer_info@MostVistited');
Route::get('/Checkin_3_hr', 'Customer_info@Checkin_3_hr');
Route::get('/Monthly_Bill', 'Customer_info@Monthly_Bill');
// change
