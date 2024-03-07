<?php
Route::group([
    'prefix' => 'api/v1',
    'namespace' => 'TeamGrid\Projects\Http\Controllers'
], function() {
    Route::middleware(['auth'])->group(function() {
        Route::get('/projects', 'ProjectController@index');

        Route::group([
            'prefix' => '/project',
        ], function() {
            Route::get('/{id}', 'ProjectController@show');
            
            Route::post('/create', 'ProjectController@store');
            
            Route::patch('/update/{id}', 'ProjectController@update');
            Route::patch('/complete/{id}', 'ProjectController@complete');
        });
    });
});
?>