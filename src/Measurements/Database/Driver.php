<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Database;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class Driver extends Measurement
{
    public function key(): string
    {
        return 'database.driver';
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
