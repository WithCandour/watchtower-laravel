<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Queue;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class Driver extends Measurement
{
    public function key(): string
    {
        return 'queue.driver';
    }

    public function value(): ?string
    {
        return Config::get('queue.default');
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
