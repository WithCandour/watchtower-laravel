<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Cache;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class Driver extends Measurement
{
    public function key(): string
    {
        return 'cache.driver';
    }

    public function value(): ?string
    {
        return Config::get('cache.default');
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
