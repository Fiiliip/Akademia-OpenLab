<?php
Route::group([
    'prefix' => 'api/v1',
    'namespace' => 'TeamGrid\Tasks\Http\Controllers',
], function() {
    Route::middleware(['auth'])->group(function() {
        Route::get('/tasks/{project_id}', 'TaskController@index');

        Route::group([
            'prefix' => '/task',
        ], function() {
            Route::get('/{id}', 'TaskController@show');

            Route::post('/create', 'TaskController@store');

            Route::patch('/update/{id}', 'TaskController@update');
            Route::patch('/complete/{id}', 'TaskController@complete');
        });
    });
});
?>