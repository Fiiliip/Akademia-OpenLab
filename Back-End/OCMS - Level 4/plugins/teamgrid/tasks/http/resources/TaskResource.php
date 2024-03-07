<?php namespace TeamGrid\Tasks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TeamGrid\Tasks\Models\Task;

use TeamGrid\Projects\Http\Resources\ProjectResource;
use TeamGrid\Projects\Models\Project;

class TaskResource extends JsonResource {
    public function toArray($request) {
        return [
            "id" => $this->id,
            "project" => new ProjectResource($this->project),
            "title" => $this->title,
            "planned_start" => $this->planned_start,
            "planned_end" => $this->planned_end,
            "planned_time" => $this->planned_time,
            "is_completed" => $this->is_completed
        ];
    }
}