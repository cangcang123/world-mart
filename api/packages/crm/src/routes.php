<?php

Route::prefix('user-profile')->group(function () {
    Route::get('/', 'UserProfileController@list');
    Route::post('/', 'UserProfileController@create');
    Route::get('/count', 'UserProfileController@count');
    Route::get('/distinct/{field}', 'UserProfileController@distinct');
    Route::get('/{id}', 'UserProfileController@detail');
    Route::patch('/{id}', 'UserProfileController@update');
    Route::delete('/{id}', 'UserProfileController@delete');
});

Route::prefix('product')->group(function () {
    Route::get('/', 'ProductController@list');
    Route::post('/', 'ProductController@create');
    Route::get('/check-product', 'ProductController@checkProduct');
    Route::get('/count', 'ProductController@count');
    Route::get('/distinct/{field}', 'ProductController@distinct');
    Route::get('/{id}', 'ProductController@detail');
    Route::patch('/{id}', 'ProductController@update');
    Route::delete('/{id}', 'ProductController@delete');
});

Route::prefix('skus')->group(function () {
    Route::get('/', 'SkuController@list');
    Route::post('/', 'SkuController@create');
    Route::get('/count', 'SkuController@count');
    Route::get('/check-sku/{sku}', 'SkuController@checkSku');
    Route::get('/{id}', 'SkuController@detail');
    Route::patch('/{id}', 'SkuController@update');
    Route::delete('/{id}', 'SkuController@delete');
    Route::get('/product/{id}', 'SkuController@getSkuByProduct');
});

Route::prefix('order')->group(function () {
    Route::get('/', 'OrderController@list');
    Route::get('/{id}', 'OrderController@detail');
    Route::patch('/{id}', 'OrderController@update');
    Route::delete('/{id}', 'OrderController@delete');
});

Route::prefix('order-product')->group(function () {
    Route::get('/', 'OrderProductController@list');
    // Route::delete('/{id}', 'OrderController@delete');
});

Route::prefix('product-review')->group(function () {
    Route::get('/product/{id}', 'ProductReviewController@listByProduct');
    Route::get('/add-review', 'ProductReviewController@submitReview');
});

Route::prefix('category')->group(function () {
    Route::get('/', 'CategoryController@list');
    Route::post('/', 'CategoryController@create');
    Route::get('/count', 'CategoryController@count');
    Route::get('/distinct/{field}', 'CategoryController@distinct');
    Route::get('/{id}', 'CategoryController@detail');
    Route::patch('/{id}', 'CategoryController@update');
    Route::delete('/{id}', 'CategoryController@delete');
});

Route::prefix('promotion')->group(function () {
    Route::get('/', 'PromotionController@list');
    Route::post('/', 'PromotionController@create');
    Route::get('/count', 'PromotionController@count');
    Route::get('/distinct/{field}', 'PromotionController@distinct');
    Route::get('/{id}', 'PromotionController@detail');
    Route::patch('/{id}', 'PromotionController@update');
    Route::delete('/{id}', 'PromotionController@delete');
});

Route::prefix('voucher')->group(function () {
    Route::get('/', 'UserPromotionController@list');
    Route::get('/count', 'UserPromotionController@count');
    Route::get('/distinct/{field}', 'UserPromotionController@distinct');
    Route::get('/{id}', 'UserPromotionController@detail');
    Route::patch('/{id}', 'UserPromotionController@update');
    Route::delete('/{id}', 'UserPromotionController@delete');
});

Route::prefix('size')->group(function () {
    Route::get('/', 'SizeController@list');
    Route::post('/', 'SizeController@create');
    Route::get('/count', 'SizeController@count');
    Route::get('/distinct/{field}', 'SizeController@distinct');
    Route::get('/{id}', 'SizeController@detail');
    Route::patch('/{id}', 'SizeController@update');
    Route::delete('/{id}', 'SizeController@delete');
});

Route::prefix('brand')->group(function () {
    Route::get('/', 'BrandController@list');
    Route::post('/', 'BrandController@create');
    Route::get('/count', 'BrandController@count');
    Route::get('/distinct/{field}', 'BrandController@distinct');
    Route::get('/{id}', 'BrandController@detail');
    Route::patch('/{id}', 'BrandController@update');
    Route::delete('/{id}', 'BrandController@delete');
});


Route::prefix('color')->group(function () {
    Route::get('/', 'ColorController@list');
    Route::post('/', 'ColorController@create');
    Route::get('/count', 'ColorController@count');
    Route::get('/distinct/{field}', 'ColorController@distinct');
    Route::get('/{id}', 'ColorController@detail');
    Route::patch('/{id}', 'ColorController@update');
    Route::delete('/{id}', 'ColorController@delete');
});

Route::prefix('user-referral')->group(function () {
    Route::get('/', 'UserReferral@list');
    Route::get('/count', 'UserReferral@count');
});

Route::prefix('product-review')->group(function () {
    Route::get('/', 'ProductReviewController@list');
    Route::patch('/{id}', 'ProductReviewController@update');
    Route::get('/count', 'ProductReviewController@count');
});

Route::prefix('user-tag')->group(function () {
    Route::get('/', 'UserTagController@list');
    Route::post('/', 'UserTagController@create');
    Route::get('/count', 'UserTagController@count');
    Route::get('/{id}', 'UserTagController@detail');
    Route::patch('/{id}', 'UserTagController@update');
    Route::delete('/{id}', 'UserTagController@delete');
});

Route::prefix('configs')->group(function () {
    Route::get('/', 'ConfigController@list');
    Route::post('/', 'ConfigController@create');
    Route::get('/count', 'ConfigController@count');
    Route::get('/{id}', 'ConfigController@detail');
    Route::patch('/{id}', 'ConfigController@update');
    Route::delete('/{id}', 'ConfigController@delete');
});

// Route::prefix('files')->group(function () {
//     Route::get('/', 'LogExportFilesController@list');
//     Route::get('/log-import', 'LogImportFilesController@list');
//     Route::get('/download', 'LogExportFilesController@downloadFile');
//     Route::post('/import', 'LogImportFilesController@importFile');
// });