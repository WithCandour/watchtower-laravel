<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Statamic;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Config;

class MultiSite extends Measurement
{
    public function key(): string
    {
        return 'statamic.multi_site.enabled';
    }

    public function value(): ?string
    {
        if (!class_exists(\Statamic\Sites\Sites::class)) {
            return 'not_installed';
        }

        try {
            $sites = Config::get('statamic.sites.sites', []);
            return count($sites) > 1 ? '1' : '0';
        } catch (\Exception $e) {
            return '0';
        }
    }

    public function type(): string
    {
        return Measurement::TYPE_BOOLEAN;
    }
}
