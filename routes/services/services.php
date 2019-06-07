<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Services'], function() {
        // views
        Route::group(['prefix' => 'services'], function() {
            Route::view('/', 'services.index')->name('services.index')->middleware('permission:read-services');
            Route::view('/create', 'services.create')->middleware('permission:create-services');
            Route::view('/{service}/edit', 'services.edit')->middleware('permission:update-services');
        });

        // api
        Route::group(['prefix' => 'api/services'], function() {
            Route::get('/count', 'ServiceController@count');
            Route::get('/all', 'ServiceController@all');
            Route::post('/filter', 'ServiceController@filter')->middleware('permission:read-services');

            Route::get('/{service}', 'ServiceController@show')->middleware('permission:read-services');
            Route::post('/store', 'ServiceController@store')->middleware('permission:create-services');
            Route::put('/update/{service}', 'ServiceController@update')->middleware('permission:update-services');
            Route::delete('/{service}', 'ServiceController@destroy')->middleware('permission:delete-services');
            Route::get('/getServiceData/{service}', 'ServiceController@getServiceData')->middleware('permission:update-services');

        });
    });
});
