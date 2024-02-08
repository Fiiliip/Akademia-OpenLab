<?php
    Route::group([
        'prefix' => 'api/v1/arrival',
        'namespace' => 'App\Arrival\Http\Controllers',
    ], function() {
        Route::get('/arrivals', 'ArrivalController@getArrivals');
        Route::get('/arrival/{id}', 'ArrivalController@getArrival');
        
        Route::post('/arrival', 'ArrivalController@createArrival');
    });
?>