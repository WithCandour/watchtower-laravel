<?php

namespace Watchtower\WatchtowerLaravel;

use Illuminate\Support\Collection;
use Watchtower\WatchtowerLaravel\Measurements\PHP;
use Watchtower\WatchtowerLaravel\Measurements\Laravel;
use Watchtower\WatchtowerLaravel\Measurements\System;
use Watchtower\WatchtowerLaravel\Measurements\Statamic;

class WatchtowerLaravel
{
    public function measurements(): array
    {
        return Collection::make([
            PHP\Version::class,
            PHP\MemoryLimit::class,
            PHP\MaxFileUpload::class,
            PHP\OpcacheEnabled::class,
            PHP\ExecutionTime::class,
            PHP\ErrorReporting::class,
            Laravel\Version::class,
            Laravel\DebugMode::class,
            Laravel\Environment::class,
            Laravel\MaintenanceMode::class,
            Laravel\HorizonStatus::class,
            System\Timezone::class,
            System\DatabaseDriver::class,
            System\CacheDriver::class,
            System\QueueEnabled::class,
            System\QueueDriver::class,
            System\DatabaseConnection::class,
            System\RedisConnection::class,
            Statamic\LicenseStatus::class,
            Statamic\AssetDriver::class,
            Statamic\SearchDriver::class,
            Statamic\StacheDriver::class,
            Statamic\StaticCaching::class,
            Statamic\MultiSite::class,
        ])
            ->map(function (string $class) {
                $instance = new $class;

                return [
                    'key' => $instance->key(),
                    'value' => $instance->value(),
                    'type' => $instance->type(),
                ];
            })
            ->values()
            ->toArray();
    }

    public function events(): array
    {
        // TODO: Add events
        return [];
    }

    public function dependencies(): array
    {
        // TODO: Add dependencies
        return [];
    }
}
