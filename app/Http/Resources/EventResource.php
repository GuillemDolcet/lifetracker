<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start' => $this->start_date->toIso8601String(),
            'end' => $this->end_date->toIso8601String(),
            'color' => $this->color,
            'allDay' => $this->is_all_day
        ];
    }
}
