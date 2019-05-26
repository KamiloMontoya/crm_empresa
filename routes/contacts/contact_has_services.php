<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'ContactHasServices'], function() {

        Route::group(['prefix' => 'contact_has_services'], function() {
        	Route::get('/', 'ContactHasServiceController@index')->name('contact_has_services.index');
            Route::get('/store', 'ContactHasServiceController@store')->name('contact_has_services.store');
            Route::delete('/{id}', 'ContactHasServiceController@destroy')->name('contact_has_services.destroy');
        });
    });
});