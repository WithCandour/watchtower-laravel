<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Statamic;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class SearchDriver extends Measurement
{
    public function key(): string
    {
        return 'statamic.search.driver';
    }

    public function value(): ?string
    {
        if (!class_exists(\Statamic\Search\Index::class)) {
            return 'not_installed';
        }

        return Config::get('statamic.search.indexes.default.driver') ?? 'local';
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
