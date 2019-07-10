<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Contacts'], function() {

        Route::group(['prefix' => 'contacts'], function() {
            Route::get('/', 'ContactController@index')
                        ->name('contacts.index')
                        ->middleware('permission:read-contacts');

            Route::get('/create', 'ContactController@create')
                    ->name('contacts.create')
                    ->middleware('permission:create-contacts');

            Route::post('/store', 'ContactController@store')
                            ->name('contacts.store')
                            ->middleware('permission:create-contacts');

            Route::get('/{contact}/edit', 'ContactController@edit')
                        ->name('contacts.edit')
                        ->middleware('permission:read-contacts');


            Route::put('/update/{contact}', 'ContactController@update')
                        ->name('contacts.update')
                        ->middleware('permission:update-contacts');
        });
    });
});
