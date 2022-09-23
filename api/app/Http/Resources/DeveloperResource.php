<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class DeveloperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'level_data' => [
                'id' => $this->level_id,
                'name' => $this->level->name,
            ],
            'created_at' => Carbon::create($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::create($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
