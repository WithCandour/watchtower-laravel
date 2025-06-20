<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Laravel;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class DebugMode extends Measurement
{
    public function key(): string
    {
        return 'laravel.debug.enabled';
    }

    public function value(): ?string
    {
        return Config::get('app.debug') ? '1' : '0';
    }

    public function type(): string
    {
        return Measurement::TYPE_BOOLEAN;
    }
}
