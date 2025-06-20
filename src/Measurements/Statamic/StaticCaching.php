<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Statamic;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class StaticCaching extends Measurement
{
    public function key(): string
    {
        return 'statamic.static_caching.strategy';
    }

    public function value(): ?string
    {
        if (!class_exists(\Statamic\Facades\StaticCache::class)) {
            return null;
        }

        return Config::get('statamic.static_caching.strategy', 'not_configured');
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
