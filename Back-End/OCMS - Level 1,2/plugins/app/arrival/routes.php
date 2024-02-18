<?php
    Route::group([
        'prefix' => 'api/v1/arrival',
        'namespace' => 'App\Arrival\Http\Controllers',
    ], function() {
        Route::middleware(['auth'])->group(function() {
            Route::get('/arrival/{user_id}', 'ArrivalController@show');
            Route::post('/arrival', 'ArrivalController@store');
        });

        Route::get('/arrivals', 'ArrivalController@index');


    });
?>