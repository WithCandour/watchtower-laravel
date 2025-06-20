<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Laravel\Horizon;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Artisan;

class Status extends Measurement
{
    public function key(): string
    {
        return 'laravel.horizon.status';
    }

    public function value(): ?string
    {
        if (!class_exists('\\Laravel\\Horizon\\Horizon')) {
            return null;
        }

        $output = [];
        $returnCode = 0;

        Artisan::call('horizon:status', [], $output, $returnCode);

        if ($returnCode === 0) {
            return 'running';
        } elseif ($returnCode === 1) {
            return 'paused';
        } elseif ($returnCode === 2) {
            return 'inactive';
        } else {
            return null;
        }
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }


}
