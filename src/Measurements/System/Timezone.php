<?php

namespace Watchtower\WatchtowerLaravel\Measurements\System;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;

class Timezone extends Measurement
{
    public function key(): string
    {
        return 'system.timezone';
    }

    public function value(): ?string
    {
        return date_default_timezone_get();
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
