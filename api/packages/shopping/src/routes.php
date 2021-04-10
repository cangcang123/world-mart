<?php

Route::prefix('shop')->group(function () {
    Route::get('/minh', 'RegisterController@minh');
    Route::post('/create-user', 'RegisterController@createByPhone');
    Route::get('/check-otp', 'RegisterController@checkOTP');
    Route::get('/update-user', 'RegisterController@updateProfile');
});

Route::prefix('shop-api')->group(function () {
    Route::post('/login', 'LoginController@loginMobile');
    Route::post('/check-phone', 'LoginController@checkPhone');
    Route::post('/get-info', 'LoginController@getProfileFromToken');
    Route::post('/register', 'LoginController@registerMobile');
    Route::post('/update-pwd', 'LoginController@updatePassword');
    Route::post('/reset-pwd', 'LoginController@resetPassword');
    Route::post('/logout', 'LoginController@logoutMobile');
    Route::post('/verify-referral', 'LoginController@verifyReferral');
    Route::post('/verify-email', 'LoginController@verifyEmail');
});

Route::prefix('product')->group(function () {
    Route::get('/list', 'ProductController@list');
    Route::get('/{id}', 'ProductController@productDetail');
});

Route::prefix('category')->group(function () {
    Route::get('/detail/{id}', 'CategoryController@detail');
    Route::get('/list', 'CategoryController@list');
    Route::post('/category-products', 'CategoryController@productPaging');
});


Route::prefix('brand')->group(function () {
    Route::get('/detail/{id}', 'BrandController@detail');
    Route::get('/list', 'BrandController@list');
    Route::post('/brand-products', 'BrandController@productPaging');
});

Route::prefix('search')->group(function () {
    Route::post('/search-by-type', 'SearchController@search');
    Route::post('/search-paging', 'SearchController@searchPaging');
});

Route::prefix('home')->group(function () {
    Route::get('/index', 'HomeController@home');
});

Route::prefix('user-activity')->group(function () {
    Route::post('/like', 'UserActivityController@userAction');
});

Route::prefix('product-review')->group(function () {
    Route::get('/product/{id}', 'ProductReviewController@listByProduct');
    Route::post('/add-review', 'ProductReviewController@submitReview');
});

Route::prefix('promotion')->group(function () {
    Route::get('/list', 'PromotionController@list');
    Route::get('/list-by-product', 'PromotionController@listByProduct');
    Route::post('/add', 'PromotionController@add');
    Route::post('/edit', 'PromotionController@edit');
    Route::post('/close/{id}', 'PromotionController@closePromo');
    Route::post('/delete-promo/{id}', 'PromotionController@deletePromo');
    Route::get('/detail/{id}', 'PromotionController@detail');
});

Route::prefix('order')->group(function () {
    Route::post('/add', 'OrderController@makeOrder');
    Route::get('/detail', 'OrderController@detail');
    Route::get('/list-order/{id}', 'OrderController@getOrderByUser');
});

Route::prefix('profile-wallet')->group(function () {
    Route::get('/info', 'ProfileController@walletInfo');
    Route::post('/identity-update', 'ProfileController@updateIdentity');
    Route::post('/banking-update', 'ProfileController@updateBanking');
    Route::get('/payment-history', 'ProfileController@paymentHistory');
});