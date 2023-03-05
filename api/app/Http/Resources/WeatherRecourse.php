<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherRecourse extends JsonResource
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
            'temp'      => $this->when($this->temp != null, $this->temp),
            'temp_unit'     => $this->when($this->temp_unit != null, $this->temp_unit),
            'pressure'  => $this->when($this->pressure != null, $this->pressure),
            'humidity' => $this->when($this->humidity != null, $this->humidity)
        ];
    }
}
