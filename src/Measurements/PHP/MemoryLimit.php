<?php

namespace Watchtower\WatchtowerLaravel\Measurements\PHP;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;

class MemoryLimit extends Measurement
{
    public function key(): string
    {
        return 'php.memory.limit';
    }

    public function value(): ?string
    {
        return ini_get('memory_limit');
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
