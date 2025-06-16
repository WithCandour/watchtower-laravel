<?php

namespace Watchtower\WatchtowerLaravel\Measurements\PHP\Opcache;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;

class Enabled extends Measurement
{
    public function key(): string
    {
        return 'php.opcache.enabled';
    }

    public function value(): ?string
    {
        return function_exists('opcache_get_status') && opcache_get_status() ? 'true' : 'false';
    }

    public function type(): string
    {
        return Measurement::TYPE_BOOLEAN;
    }
}
