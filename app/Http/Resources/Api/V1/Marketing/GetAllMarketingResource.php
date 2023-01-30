<?php

namespace App\Http\Resources\Api\V1\Marketing;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllMarketingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->getImageUrl(),
        ];
    }
}
