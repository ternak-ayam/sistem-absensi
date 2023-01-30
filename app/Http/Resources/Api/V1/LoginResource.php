<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'accessToken' => $this->createToken($request->userAgent())->plainTextToken,
            'role' => $this->role
        ];
    }
}
