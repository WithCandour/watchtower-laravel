<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Statamic;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class AssetDriver extends Measurement
{
    public function key(): string
    {
        return 'statamic.assets.driver';
    }

    public function value(): ?string
    {
        if (!class_exists(\Statamic\Assets\AssetContainer::class)) {
            return 'not_installed';
        }

        return Config::get('statamic.assets.container') ?? 'local';
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
