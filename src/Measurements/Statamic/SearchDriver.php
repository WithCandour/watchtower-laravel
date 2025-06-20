<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Statamic;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class SearchDriver extends Measurement
{
    public function key(): string
    {
        return 'statamic.search_driver';
    }

    public function value(): ?string
    {
        if (!class_exists(\Statamic\Search\Index::class)) {
            return null;
        }

        return Config::get('statamic.search.indexes.default.driver');
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
