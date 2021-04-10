<?php

Route::get('/', function () {
    if(env('APP_ENV') === 'production') {
        if (file_exists(public_path('crm/index.html'))) {
            return file_get_contents(public_path('crm/index.html'));
        }
    }
});