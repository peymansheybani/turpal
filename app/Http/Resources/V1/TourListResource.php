<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TourListResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
