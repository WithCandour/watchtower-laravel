<?php

namespace Watchtower\WatchtowerLaravel\Measurements\PHP;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;

class ErrorReporting extends Measurement
{
    public function key(): string
    {
        return 'php.error_reporting';
    }

    public function value(): ?string
    {
        return (string) error_reporting();
    }

    public function type(): string
    {
        return Measurement::TYPE_INTEGER;
    }
}
