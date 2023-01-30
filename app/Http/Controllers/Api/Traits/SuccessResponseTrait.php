<?php

namespace App\Http\Controllers\Api\Traits;

trait SuccessResponseTrait {
    public function success(): array
    {
        return [
          'data' => new \stdClass(),
        ];
    }
}
