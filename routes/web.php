<?php

use Illuminate\Support\Facades\DB;
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

Auth::routes();
/**
 * Роуты для юзверя
 */
Route::get('/', 'ControlController@welcomePage')->name('welcome');
Route::post('getMovie', 'ControlController@getMovie')->name('getMovie');
Route::post('getMovieVideo', 'ControlController@getMovieVideo')->name('getMovieVideo');
Route::get('reservation/{id}/{buyId}', 'ControlController@reservation')->name('reservationMovie');
Route::post('reservationCancel', 'ControlController@reservationCancel')->name('reservationCancel');
/**
 * Роуты для админа
 */
Route::get('home', 'HomeController@index')->name('home');
Route::get('admin', 'HomeController@index')->name('admin');
Route::get('addMovie', 'HomeController@addMovie')->name('addMovie');
Route::post('add', 'HomeController@add')->name('add');
Route::get('cashbox', 'HomeController@cashbox')->name('cashbox');
Route::get('admin/cashbox/{id}/{uniqReservation}', 'HomeController@cashboxReservation')->name('cashboxReservation');
Route::post('admin-payment', 'StripeController@adminPayment')->name('admin.payment');
/**
 * Неутральные роуты нужны и там и там
 */
Route::get('reservationCancel', function () {
    return view('cancel');
})->name('reservationCancelView');
Route::get('reservationSuccess', function () {
    return view('success');
})->name('reservationSuccess');
Route::get('mail', function () {
    return view('mail');
});
Route::post('stripe-payment', 'StripeController@userPayment')->name('stripe.payment');