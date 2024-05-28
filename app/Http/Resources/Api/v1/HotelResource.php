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
            'imageIds' => $this->when($this->images->isNotEmpty(), $this->images->pluck('id')),
            'roomIds' => $this->when($this->rooms->isNotEmpty(), $this->rooms->pluck('id')),
        ];
    }
}
