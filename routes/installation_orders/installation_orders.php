<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'InstallationOrders'], function() {

        Route::group(['prefix' => 'installation_orders'], function() {
            Route::get('/', 'InstallationOrderController@index')->name('installation_orders.index');
            Route::get('/store', 'InstallationOrderController@store')->name('installation_orders.store');
            Route::get('/{installation_order}/edit', 'InstallationOrderController@edit')->name('installation_orders.edit');
            Route::put('/update/{installation_order}', 'InstallationOrderController@update')->name('installation_orders.update');
           
        });
       
    });
}); 