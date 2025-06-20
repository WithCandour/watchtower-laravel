<?php

namespace Watchtower\WatchtowerLaravel\Measurements\System;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class QueueEnabled extends Measurement
{
    public function key(): string
    {
        return 'system.queue.enabled';
    }

    public function value(): ?string
    {
        $connection = Config::get('queue.default');
        return $connection && $connection !== 'sync' ? 'true' : 'false';
    }

    public function type(): string
    {
        return Measurement::TYPE_BOOLEAN;
    }
}
