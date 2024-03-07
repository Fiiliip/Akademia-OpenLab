<?php namespace TeamGrid\TimeEntries\Http\Controllers;

use Backend\Classes\Controller;
use Illuminate\Http\Request;

use TeamGrid\TimeEntries\Models\TimeEntry;
use TeamGrid\TimeEntries\Http\Resources\TimeEntryResource;

class TimeEntryController extends Controller {
    public function start($task_id) {
        $timeEntry = new TimeEntry();
        $timeEntry->task_id = $task_id;
        $timeEntry->user_id = auth()->user()->id;
        $timeEntry->start_time = now();
        $timeEntry->save();
        return new TimeEntryResource($timeEntry);
    }

    public function stop($timeEntry_id) {
        $timeEntry = TimeEntry::where('id', $timeEntry_id)->first();
        if ($timeEntry->end_time) {
            return response()->json(['message' => 'Time entry already stopped'], 400);
        }
        $timeEntry->end_time = now();
        $timeEntry->save();
        return new TimeEntryResource($timeEntry);
    }
}