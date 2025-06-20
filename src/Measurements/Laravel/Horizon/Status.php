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

        $status = Artisan::call('horizon:status');

        return match ($status) {
            0 => 'running',
            1 => 'paused',
            2 => 'inactive',
            default => null,
        };
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }

}
