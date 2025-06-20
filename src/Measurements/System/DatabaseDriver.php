<?php

namespace Watchtower\WatchtowerLaravel\Measurements\System;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class DatabaseDriver extends Measurement
{
    public function key(): string
    {
        return 'system.database.driver';
    }

    public function value(): ?string
    {
        return Config::get('database.default');
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
