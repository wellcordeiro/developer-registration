<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class LevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => Carbon::create($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::create($this->updated_at)->format('Y-m-d H:i:s'),
            'developers' => [
                'href' => route('developers.index', ['level_id' => $this->id]),
                'count' => $this->developers()->count(),
            ],
        ];
    }
}
