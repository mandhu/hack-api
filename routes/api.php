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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('users', 'UserAPIController');

Route::resource('categories', 'CategoryAPIController');

Route::resource('products', 'ProductAPIController');

Route::resource('product_names', 'ProductNameAPIController');

Route::resource('listings', 'ListingAPIController');

Route::resource('purchases', 'PurchaseAPIController');

Route::resource('promotions', 'PromotionAPIController');

Route::resource('transactions', 'TransactionAPIController');

Route::resource('transfers', 'TransferAPIController');