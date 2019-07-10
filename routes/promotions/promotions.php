<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Promotions'], function() {

        Route::group(['prefix' => 'promotions'], function() {
            Route::get('/', 'PromotionController@index')
            		->name('promotions.index')
            		->middleware('permission:read-promotions');

            Route::get('/create', 'PromotionController@create')
                    ->name('promotions.create')
                    ->middleware('permission:create-promotions');

            Route::post('/store', 'PromotionController@store')
            		->name('promotions.store')
            		->middleware('permission:create-promotions');

            Route::get('/{promotions_status}/edit', 'PromotionController@edit')
            		->name('promotions.edit')
            		->middleware('permission:update-promotions');

            Route::put('/update/{promotions_status}', 'PromotionController@update')
            		->name('promotions.update')
            		->middleware('permission:update-promotions');

            // Route::delete('/{promotions_status}', 'PromotionController@destroy')
            //  ->name('promotions.destroy')
            //  ->middleware('permission:delete-promotions');
           
        });
       
    });
}); 