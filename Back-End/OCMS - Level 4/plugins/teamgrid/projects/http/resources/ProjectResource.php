<?php namespace TeamGrid\Projects\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TeamGrid\Projects\Models\Project;

use LibUser\Userapi\Http\Resources\UserResource;
use LibUser\Userapi\Models\User;

class ProjectResource extends JsonResource {
    public function toArray($request) {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "customer" => new UserResource($this->customer),
            "project_manager" => new UserResource($this->project_manager),
            "is_completed" => $this->is_completed
        ];
    }
}