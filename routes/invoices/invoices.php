<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Invoices'], function() {

        Route::group(['prefix' => 'invoices'], function() {
        	Route::get('/', 'InvoiceController@index')
        			->name('invoices.index')
        			->middleware('permission:read-invoices');


            Route::get('/create/{contact_has_service_id}', 'InvoiceController@create')
                    ->name('invoices.create')
                    ->middleware('permission:create-invoices');

            Route::post('/store', 'InvoiceController@store')
            		->name('invoices.store')
            		->middleware('permission:create-invoices');

        });
    });
});