<?php

namespace Watchtower\WatchtowerLaravel\Measurements\System;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class CacheDriver extends Measurement
{
    public function key(): string
    {
        return 'system.cache.driver';
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
