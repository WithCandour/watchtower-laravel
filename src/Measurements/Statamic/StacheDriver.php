<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Statamic;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class StacheDriver extends Measurement
{
    public function key(): string
    {
        return 'statamic.stache.driver';
    }

    public function value(): ?string
    {
        if (!class_exists(\Statamic\Stache\Stache::class)) {
            return 'not_installed';
        }

        return Config::get('statamic.stache.driver', 'file');
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
