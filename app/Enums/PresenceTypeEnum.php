<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

class PresenceTypeEnum extends Enum {
    const IN = 'in';
    const OUT = 'out';
}
