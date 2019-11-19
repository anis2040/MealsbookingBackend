<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
    Route::post('logout','Api\Auth\LoginController@logout');
});

Route::get('restaurants','RestaurantController@index');

Route::get('topten','RestaurantController@topTen');


Route::get('restaurant/{id}','RestaurantController@show');

Route::get('restaurant-category/{category}','RestaurantController@sortByCategory');


Route::post('restaurant','RestaurantController@store');

Route::put('restaurant','RestaurantController@store');

Route::delete('restaurant/{id}','RestaurantController@destroy');

Route::post('register','Api\Auth\RegisterController@register');

Route::post('login','Api\Auth\LoginController@login');

Route::post('refresh','Api\Auth\LoginController@refresh');


// Reservation rotes

Route::get('reservations','ReservationController@index');

Route::post('reservation','ReservationController@store');

Route::put('reservation','ReservationController@store');

Route::delete('reservation/{id}','ReservationController@destroy');





