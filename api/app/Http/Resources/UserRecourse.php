<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRecourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->when($this->id != null, $this->id),
            'name'      => $this->when($this->name != null, $this->name),
            'email'     => $this->when($this->email != null, $this->email),
            'latitude'  => $this->when($this->latitude != null, $this->latitude),
            'longitude' => $this->when($this->longitude != null, $this->longitude)
        ];
    }
}
