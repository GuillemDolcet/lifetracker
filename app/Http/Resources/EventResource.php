<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'start' => $this->start_date->toIso8601String(),
            'end' => $this->end_date->toIso8601String(),
        ];
    }
}
