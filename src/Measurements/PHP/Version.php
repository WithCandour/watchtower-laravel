<?php

namespace Watchtower\WatchtowerLaravel\Measurements\PHP;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;

class Version extends Measurement
{
    public function key(): string
    {
        return 'php_version';
    }

    public function value(): ?string
    {
        return PHP_VERSION;
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}