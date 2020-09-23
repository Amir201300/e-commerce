<?php


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
use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

header('Content-Type: application/json; charset=UTF-8', true);


/** Start Auth Route **/

Route::middleware('auth:api')->group(function () {
    //Auth_private
    Route::prefix('Auth_private')->group(function()
    {
        Route::post('/change_password', 'Api\UserController@change_password')->name('user.change_password');
        Route::post('/edit_profile', 'Api\UserController@edit_profile')->name('user.edit_profile');
        Route::get('/my_wishlist', 'Api\UserController@my_wishlist')->name('user.my_wishlist');
        Route::get('/my_cart', 'Api\UserController@my_cart')->name('user.my_cart');
        Route::post('/settings', 'Api\UserController@settings')->name('user.settings');
        Route::get('/my_info', 'Api\UserController@my_info')->name('user.my_info');
    });

});
/** End Auth Route **/

//general Auth
Route::prefix('Auth_general')->group(function()
{
    Route::post('/register', 'Api\UserController@register')->name('user.register');
    Route::post('/login', 'Api\UserController@login')->name('user.login');
    Route::get('/check_virfuy/{id}', 'Api\UserController@check_virfuy')->name('user.check_virfuy');
    Route::post('/forget_password', 'Api\UserController@forget_password')->name('user.forget_password');
    Route::post('/reset_password', 'Api\UserController@reset_password')->name('user.reset_password');
});