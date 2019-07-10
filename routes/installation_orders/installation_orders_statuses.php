<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'InstallationOrders'], function() {

        Route::group(['prefix' => 'installation_orders_statuses'], function() {
            Route::get('/', 'InstallationOrderStatusController@index')
            		->name('installation_orders_statuses.index')
            		->middleware('permission:read-installation_order');

            Route::get('/create', 'InstallationOrderStatusController@create')
                    ->name('installation_orders_statuses.create')
                    ->middleware('permission:create-installation_order');

            Route::post('/store', 'InstallationOrderStatusController@store')
            		->name('installation_orders_statuses.store')
            		->middleware('permission:create-installation_order');

            Route::get('/{installation_order_status}/edit', 'InstallationOrderStatusController@edit')
            		->name('installation_orders_statuses.edit')
            		->middleware('permission:update-installation_order');

            Route::put('/update/{installation_order_status}', 'InstallationOrderStatusController@update')
            		->name('installation_orders_statuses.update')
            		->middleware('permission:update-installation_order');

             Route::delete('/{installation_order_status}', 'InstallationOrderStatusController@destroy')
             ->name('installation_orders_statuses.destroy')
             ->middleware('permission:delete-installation_order');
           
        });
       
    });
}); 