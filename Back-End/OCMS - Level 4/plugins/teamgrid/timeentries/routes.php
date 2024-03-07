<?php
Route::group([
    'prefix' => 'api/v1/time-entry',
    'namespace' => 'TeamGrid\TimeEntries\Http\Controllers'
], function() {
    Route::middleware(['auth'])->group(function() {
        Route::post('/start/{task_id}', 'TimeEntryController@start');
        Route::get('/stop/{id}', 'TimeEntryController@stop');
    });
});
?>