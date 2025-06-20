<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Queue;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class Enabled extends Measurement
{
    public function key(): string
    {
        return 'queue.enabled';
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
