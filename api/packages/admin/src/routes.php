<?php

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    // Route::post('sso-auth', 'AuthController@sso_auth');
});

Route::prefix('users')->group(function () {
    Route::get('/', 'UserController@list');
    Route::post('/', 'UserController@create');
    Route::post('/reset-pass', 'UserController@resetPass');
    Route::post('/change-pass', 'UserController@changePass');
    Route::get('/{id}', 'UserController@detail');
    Route::patch('/{id}', 'UserController@update');
});

Route::prefix('roles')->group(function () {
    Route::get('/', 'RoleController@list');
    Route::post('/', 'RoleController@create');
    Route::get('/{id}', 'RoleController@detail');
    Route::patch('/{id}', 'RoleController@update');
});

Route::prefix('packages')->group(function () {
    Route::get('/', 'PackageController@list');
    Route::post('/', 'PackageController@create');
    Route::get('/{id}', 'PackageController@detail');
    Route::patch('/{id}', 'PackageController@update');
});

Route::prefix('resources')->group(function () {
    Route::get('/', 'ResourceController@list');
    Route::post('/', 'ResourceController@create');
    Route::get('/{id}', 'ResourceController@detail');
    Route::patch('/{id}', 'ResourceController@update');
});

Route::prefix('permission-role')->group(function () {
    Route::get('/', 'PermissionRoleController@list');
    Route::post('/', 'PermissionRoleController@create');
    Route::get('/{id}', 'PermissionRoleController@detail');
    Route::patch('/{id}', 'PermissionRoleController@update');
});

Route::prefix('/entries')->group(function () {
    Route::get('/fields', 'EntryController@fields');
    Route::post('/fields', 'EntryController@syncFields');
});

Route::prefix('log-actions')->group(function () {
    Route::get('/', 'LogsUserActionController@list');
    Route::get('/export', 'LogsUserActionController@export');
});

Route::prefix('geo')->group(function () {
    Route::get('provinces', 'GeographyController@provinces');
    Route::get('countries', 'GeographyController@countries');
    Route::get('districts/{id}', 'GeographyController@districts');
    Route::get('wards/{id}', 'GeographyController@wards');
});

Route::prefix('/upload')->group(function () {
    Route::post('/image', 'FileUploadController@upload');
    Route::post('/image-mb', 'FileUploadController@uploadMobile');
    Route::post('/image-multi', 'FileUploadController@uploadMulti');
    Route::post('/import-phone', 'FileUploadController@importPhoneNumber');
});

/**
 * Queue routes
 */
Route::prefix('/queue')->group(function() {
    Route::get('/delayed', 'QueueController@delayed');
    Route::delete('/delayed/{id}', 'QueueController@removeDelayedJob');
});
