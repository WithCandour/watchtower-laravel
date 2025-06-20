<?php

namespace Watchtower\WatchtowerLaravel\Measurements\System;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class QueueDriver extends Measurement
{
    public function key(): string
    {
        return 'system.queue.driver';
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
