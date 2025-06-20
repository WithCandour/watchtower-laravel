<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Laravel;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Http;

class HorizonStatus extends Measurement
{
    public function key(): string
    {
        return 'laravel.horizon.status';
    }

    public function value(): ?string
    {
        if (!class_exists('\\Laravel\\Horizon\\Horizon')) {
            return 'not_installed';
        }

        try {
            $response = Http::timeout(5)->get(config('app.url') . '/horizon/api/metrics');
            return $response->successful() ? 'running' : 'not_responding';
        } catch (\Exception $e) {
            return 'not_responding';
        }
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
