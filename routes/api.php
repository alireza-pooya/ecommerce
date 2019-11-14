<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('api')->group(function (){
    Route::post('/color','ProductController@getSize')->name('color');
    Route::post('/quantity','QuantityController@getQuantity')->name('quantity');
    Route::post('calculate','CalculateDiscountController@discount')->name('calculate');
});