<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Laravel;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\App;

class MaintenanceMode extends Measurement
{
    public function key(): string
    {
        return 'laravel.maintenance_mode_enabled';
    }

    public function value(): ?string
    {
        return App::isDownForMaintenance() ? 'true' : 'false';
    }

    public function type(): string
    {
        return Measurement::TYPE_BOOLEAN;
    }
}
