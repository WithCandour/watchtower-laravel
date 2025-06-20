<?php

namespace Watchtower\WatchtowerLaravel\Measurements\PHP;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;

class OpcacheEnabled extends Measurement
{
    public function key(): string
    {
        return 'php.opcache.enabled';
    }

    public function value(): ?string
    {
        return function_exists('opcache_get_status') && opcache_get_status() ? '1' : '0';
    }

    public function type(): string
    {
        return Measurement::TYPE_BOOLEAN;
    }
}
