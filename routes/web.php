<?php

//Authentication
Route::namespace('Auth')->group(function (){
    Route::get('logout','LoginController@logout')->name('logout');
    Route::get('login','LoginController@loginForm')->name('login-form');
    Route::post('login','LoginController@login')->name('login');
    Route::get('register','RegisterController@register')->name('register');
    Route::post('register','RegisterController@registerStore')->name('register.store');
    Route::get('login/google', 'LoginController@redirectToProvider')->name('google');
    Route::get('login/google/callback', 'LoginController@handleProviderCallback');


    /// reset password
    Route::get('getEmail','ResetPasswordController@getemail')->name('getemail');
    Route::post('resetpassword','ResetPasswordController@sendlink')->name('resetpassword');
    Route::get('checktoken','ResetPasswordController@checktoken')->name('reset_password');
    Route::post('setnewpassword','ResetPasswordController@setnewpassword')->name('set_password');

});
//regular pages
Route::namespace('v1')->group(function () {
    Route::get('/', 'HomePageController@index')->name('homepage.home');
    Route::get('/contact', 'ContactController@index')->name('contact.home');
    Route::post('/contact/store', 'ContactController@store')->name('contact.home.store');
    Route::get('product/{product}/show','ProductController@index')->name('product.show');
    Route::post('comment/{product}/store','CommentController@store')->name('comment.store');
    Route::get('category/{category}/search','CategoryController@search')->name('category.search');

    //ajax upload image
    Route::post('/ajaxupload' , 'SiteController@ajaxupload');
});
//dashboard - user
Route::middleware('auth')->namespace('v1')->prefix('dashboard')->group(function (){
    Route::resource('address','AddressController',['except' => ['show']]);
    Route::get('/', 'UserPanelController@index')->name('dashboard.index');
    Route::get('/profile/{user}/edit', 'UserPanelController@edit')->name('profile.edit');
    Route::patch('/profile/{user}/update', 'UserPanelController@update')->name('profile.update');
    Route::get('/profile/{user}/change-password', 'UserPanelController@changePassword')->name('profile.password.change');
    Route::patch('/profile/{user}/update-password', 'UserPanelController@updatePassword')->name('profile.password.update');
    Route::get('orders','OrderController@orders')->name('orders.index');

});
//cart and purchase
Route::middleware('auth')->namespace('v1')->group(function (){
    Route::post('chooseAnAddress','CheckoutController@checkout')->name('checkout');
    Route::post('Bank','CheckoutController@goBank')->name('Bank');
    Route::post('returnBank','CheckoutController@returnBank')->name('returnBank');
    Route::get('cart','CartController@index')->name('cart');
    Route::post('cart/{product}/add', 'CartController@addToCart')->name('cart.add');
    Route::post('cart/{store}/destroy','CartController@destroy')->name('cart.destroy');
});
////panel
Route::middleware('manager')->namespace('Panel')->prefix('panel')->group(function () {
    Route::get('/', 'PanelController@index')->name('panel');
    //add brand for product
    Route::resource('brand','BrandController',['except' => ['delete','show']]);
    //add category for product
    Route::resource('category','CategoryController',['except' => ['delete','show']]);
    //add property for product
    Route::resource('property','PropertyController',['except' => ['delete','show']]);
    //contact us
    Route::resource('contact', 'ContactController', ['except' => ['create','store','edit']]);
    //check comment
    Route::resource('comment', 'CommentController', ['except' => ['create','store','show','delete']]);
    //manage discount
    Route::resource('discount', 'DiscountController', ['except' => ['show']]);
    //manage product
    Route::resource('product', 'ProductController', ['except' => ['show']]);
    //users
    Route::resource('user', 'UserController', ['except' => ['create','store']]);
    //orders
    Route::get('user/{order}/list','UserController@orders')->name('order');
    //slide show for homepage
    Route::resource('slideshow', 'SlideShowController', ['except' => ['show','create']]);
    //topbrand slide show
    Route::resource('topbrand', 'TopBrandController', ['except' => ['show','create','edit']]);
    //define property for each product
    Route::get('product-property/{product}/index-create','ProductPropertyController@index')->name('product.property.index');
    Route::post('product-property/{product}/store','ProductPropertyController@store')->name('product.property.store');
    Route::post('product-property/{product}','ProductPropertyController@destroy')->name('product.property.destroy');
    //define quantity and color and size for each product
    Route::get('store/{product}/index','StoreController@index')->name('store.index');
    Route::post('store/{product}/store','StoreController@store')->name('store.store');
    Route::post('store/{store}/destroy','StoreController@destroy')->name('store.destroy');
    //purchase
    Route::get('purchase','PurchaseController@index')->name('purchase.index');
    Route::get('purchase/{purchase}/show','PurchaseController@show')->name('purchase.show');

});

