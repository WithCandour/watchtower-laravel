<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Laravel;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\App;

class Environment extends Measurement
{
    public function key(): string
    {
        return 'laravel.environment';
    }

    public function value(): ?string
    {
        return App::environment();
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
