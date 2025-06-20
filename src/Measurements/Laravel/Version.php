<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Laravel;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Foundation\Application;

class Version extends Measurement
{
    public function key(): string
    {
        return 'laravel.version';
    }

    public function value(): ?string
    {
        return Application::VERSION;
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
