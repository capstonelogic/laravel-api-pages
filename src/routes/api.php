<?php

Route::group(['middleware' => 'auth:api'], function() {
    Route::resource('pages', 'Http\Controllers\Api\PageController', [
        'except' => [ 'create', 'edit' ]
    ]);
});
