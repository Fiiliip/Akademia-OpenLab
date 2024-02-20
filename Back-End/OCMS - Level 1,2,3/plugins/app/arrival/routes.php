<?php
    Route::group([
        'prefix' => 'api/v1/arrival',
        'namespace' => 'App\Arrival\Http\Controllers',
    ], function() {
        Route::middleware(['auth'])->group(function() {
            Route::get('/arrival', 'ArrivalController@show');
        });

        Route::get('/arrivals', 'ArrivalController@index');

        Route::post('/arrival', 'ArrivalController@store');
    });
?>