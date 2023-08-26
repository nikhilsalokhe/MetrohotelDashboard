<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Route::get('/','Auth\LoginController@showLoginForm');
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/Total_customer', 'Customer_info@Total_customer');
Route::get('/Customer_History', 'Customer_info@Customer_History');//New Added
Route::get('/Todays_customer', 'Customer_info@Todays_customer');
Route::get('/Weeks_customer', 'Customer_info@Weeks_customer');
Route::get('/Months_customer', 'Customer_info@Months_customer');
Route::get('/MostVistited', 'Customer_info@MostVistited');
Route::get('/LeastVistited', 'Customer_info@LeastVistited');//New Added
Route::get('/company_customers/{gst_no}', 'Customer_info@Company_Customers');//New Added
Route::get('/company_bookings', 'Customer_info@Company_Bookings');//New Added
Route::get('/custom_month', 'Customer_info@Months_customer');//New Added

Route::get('/Checkin_3_hr', 'Customer_info@Checkin_3_hr');
Route::get('/Monthly_Bill', 'Customer_info@Monthly_Bill');
Route::get('/details/{Customer_Id}', 'Customer_info@Details');
Route::get('/coupondetails/{Customer_Id}', 'Customer_info@CouponDetails');  


Route::get('/one_day_details', 'Customer_info@Weeks_customer');
Route::get('/findCustomer', 'Customer_info@Months_customer');
Route::get('/dates','Customer_info@btwdates');

Route::get('/findMostCustomer', 'Customer_info@MostVistited');
Route::get('/findLeastCustomer', 'Customer_info@LeastVistited');
Route::get('/findTotalCustomer', 'Customer_info@Total_customer');

// Voucher Management Routes
Route::namespace('Voucher')->group(function () {
    Route::get('managecoupon', 'LandingPageController@index')->name('welcome');
    // Route::get('home', 'HomeController@index')->name('home');
    Route::resource('customers','CustomerController');
    // Route::resource('vouchers','VoucherController');
    Route::resource('vouchernames','VoucherNameController');
    // Route::resource('voucher-validators','VoucherValidatorController');
    Route::resource('voucher-register','VoucherRegistrationController');
    // Route::post('voucher-validators','VoucherValidatorController@checkCode')->name('checkCode');
    // Route::resource('voucher-validation-results','VoucherValidationResultController');
    Route::resource('voucher-lists','VoucherListController');
    
    Route::get('customer-voucher/{id}','VoucherListController@createVoucher');

    Route::post('create-multiple-vouchers','VoucherListController@createMultipleVouchers');

    Route::get('couponstatus/{id}','VoucherListController@StatusChange');


});

// Route::get('customer-voucher/{id}','VoucherListController@createVoucher');
// change
