<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'type' => $this->type->name,
            'description' => $this->description,
            'pricePerNight' => $this->price_per_night,
            'isAvailable' => $this->is_available,
            'images' => $this->when($this->images->isNotEmpty(), $this->image->pluck('id')),
        ];
    }
}
