<?php

namespace Watchtower\WatchtowerLaravel\Measurements;

abstract class Measurement
{
    const TYPE_BOOLEAN = 'boolean';

    const TYPE_DATE = 'date';

    const TYPE_INTEGER = 'integer';

    const TYPE_FLOAT = 'float';

    const TYPE_STRING = 'string';

    abstract public function key(): string;

    abstract public function value(): ?string;

    abstract public function type(): string;
}
