<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Statamic;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;

class MultiSite extends Measurement
{
    public function key(): string
    {
        return 'statamic.multi_site_enabled';
    }

    public function value(): ?string
    {
        if (!class_exists(\Statamic\Sites\Sites::class)) {
            return null;
        }

        try {
            $sites = \Statamic\Facades\Site::all();
            return count($sites) > 1 ? 'true' : 'false';
        } catch (\Exception $e) {
            return 'false';
        }
    }

    public function type(): string
    {
        return Measurement::TYPE_BOOLEAN;
    }
}
