<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Services'], function() {

        Route::group(['prefix' => 'services_statuses'], function() {
            Route::get('/', 'ServiceStatusController@index')
            		->name('services_statuses.index')
            		->middleware('permission:read-service_status');

            Route::get('/create', 'ServiceStatusController@create')
                    ->name('services_statuses.create')
                    ->middleware('permission:create-service_status');

            Route::post('/store', 'ServiceStatusController@store')
            		->name('services_statuses.store')
            		->middleware('permission:create-service_status');

            Route::get('/{service_status_status}/edit', 'ServiceStatusController@edit')
            		->name('services_statuses.edit')
            		->middleware('permission:update-service_status');

            Route::put('/update/{service_status_status}', 'ServiceStatusController@update')
            		->name('services_statuses.update')
            		->middleware('permission:update-service_status');

             Route::delete('/{service_status_status}', 'ServiceStatusController@destroy')
             ->name('services_statuses.destroy')
             ->middleware('permission:delete-service_status');
           
        });
       
    });
}); 