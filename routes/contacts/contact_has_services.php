<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'ContactHasServices'], function() {

        Route::group(['prefix' => 'contact_has_services'], function() {
        	Route::get('/', 'ContactHasServiceController@index')
        			->name('contact_has_services.index')
        			->middleware('permission:read-contact_has_service');

            Route::post('/store', 'ContactHasServiceController@store')
            		->name('contact_has_services.store')
            		->middleware('permission:create-contact_has_service');

            Route::delete('/{id}', 'ContactHasServiceController@destroy')
            		->name('contact_has_services.destroy')
            		->middleware('permission:delete-contact_has_service');

            Route::get('/{contact_has_service}/edit', 'ContactHasServiceController@edit')
                    ->name('contact_has_services.edit')
                    ->middleware('permission:update-contact_has_service');

            Route::put('/update/{contact_has_service}', 'ContactHasServiceController@update')
                    ->name('contact_has_services.update')
                    ->middleware('permission:update-contact_has_service');

        });
    });
});