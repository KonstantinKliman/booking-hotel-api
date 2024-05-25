<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'name' => $this->name,
            'address' => $this->address,
            'starRating' => $this->star_rating,
            'description' => $this->description,
            'images' => $this->when($this->images->isNotEmpty(), ImageResource::collection($this->images)),
            'rooms' => $this->when($this->rooms->isNotEmpty(), RoomResource::collection($this->rooms)),
        ];
    }
}
