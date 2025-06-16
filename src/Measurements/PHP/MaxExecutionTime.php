<?php

namespace Watchtower\WatchtowerLaravel\Measurements\PHP;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;

class MaxExecutionTime extends Measurement
{
    public function key(): string
    {
        return 'php.max_execution_time';
    }

    public function value(): ?string
    {
        return ini_get('max_execution_time');
    }

    public function type(): string
    {
        return Measurement::TYPE_INTEGER;
    }
}
