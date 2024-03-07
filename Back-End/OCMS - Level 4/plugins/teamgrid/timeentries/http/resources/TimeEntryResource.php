<?php namespace TeamGrid\TimeEntries\Http\Resources;

use Carbon\CarbonInterval;

use Illuminate\Http\Resources\Json\JsonResource;
use TeamGrid\TimeEntries\Models\TimeEntry;

use TeamGrid\Tasks\Http\Resources\TaskResource;
use TeamGrid\Tasks\Models\Task;

use LibUser\Userapi\Http\Resources\UserResource;
use LibUser\Userapi\Models\User;

class TimeEntryResource extends JsonResource {
    public function toArray($request) {
        return [
            "id" => $this->id,
            "task" => new TaskResource($this->task),
            "user" => new UserResource($this->user),
            "start_time" => date($this->start_time),
            "end_time" => $this->end_time ? date($this->end_time) : null,
            // "duration" => $this->end_time ? gmdate('H:i:s', strtotime($this->end_time) - strtotime($this->start_time)) : null
            // "duration" => $this->end_time ? CarbonInterval::seconds(strtotime($this->end_time) - strtotime($this->start_time))->cascade() : null
        ];
    }
}