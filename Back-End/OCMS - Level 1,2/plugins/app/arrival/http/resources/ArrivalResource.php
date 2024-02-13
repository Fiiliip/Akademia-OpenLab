<?php namespace App\Arrival\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Arrival\Models\Arrival;

use LibUser\Userapi\Http\Resources\UserResource;
use LibUser\Userapi\Models\User;

class ArrivalResource extends JsonResource {
    public function toArray($request) {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "user" => new UserResource(User::find($this->user_id)),
            "is_late" => $this->is_late,
            "created_at" => date($this->created_at)
        ];
    }
}