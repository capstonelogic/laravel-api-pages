<?php

Route::group(['middleware' => 'auth:api'], function() {
    
    Route::get('pages/statuses', 'Http\Controllers\Api\PageController@statuses');

    Route::resource('pages', 'Http\Controllers\Api\PageController', [
        'except' => [ 'create', 'edit' ]
    ]);
});
