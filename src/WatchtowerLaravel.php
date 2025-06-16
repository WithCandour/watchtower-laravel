<?php

namespace Watchtower\WatchtowerLaravel;

use Illuminate\Support\Collection;
use Throwable;
use Watchtower\WatchtowerLaravel\Measurements\PHP;
use Watchtower\WatchtowerLaravel\Measurements\Laravel;
use Watchtower\WatchtowerLaravel\Measurements\Statamic;
use Watchtower\WatchtowerLaravel\Measurements\Database;
use Watchtower\WatchtowerLaravel\Measurements\Cache;
use Watchtower\WatchtowerLaravel\Measurements\Queue;
use Watchtower\WatchtowerLaravel\Measurements\Redis;
use Watchtower\WatchtowerLaravel\Measurements\System;
use Watchtower\WatchtowerLaravel\Measurements\Git;
use Watchtower\WatchtowerLaravel\Dependencies\Composer;

class WatchtowerLaravel
{
    public function measurements(): array
    {
        return Collection::make([
            PHP\Version::class,
            PHP\MemoryLimit::class,
            PHP\MaxFileUpload::class,
            PHP\MaxExecutionTime::class,
            PHP\ErrorReporting::class,
            PHP\Opcache\Enabled::class,
            Laravel\Version::class,
            Laravel\DebugMode::class,
            Laravel\Environment::class,
            Laravel\MaintenanceMode::class,
            Laravel\Horizon\Status::class,
            Database\Driver::class,
            Cache\Driver::class,
            Queue\Enabled::class,
            Queue\Driver::class,
            Database\Connection::class,
            Redis\Connection::class,
            Statamic\LicenseStatus::class,
            Statamic\AssetDriver::class,
            Statamic\SearchDriver::class,
            Statamic\StacheDriver::class,
            Statamic\StaticCaching::class,
            Statamic\MultiSite::class,
            System\Timezone::class,
            Git\Origin::class,
            Git\Branch::class,
            Git\CommitHash::class,
            Git\CommitMessage::class,
            Git\CommitDate::class,
            Git\Author::class,
            Git\IsClean::class,
            Git\UntrackedFiles::class,
            Git\ModifiedFiles::class,
            Git\IsUpToDate::class,
            Git\AheadCount::class,
            Git\BehindCount::class,
            Git\RepositoryName::class,
            Git\GitVersion::class,
        ])
            ->map(function (string $class) {
                try {
                    $instance = new $class;

                    return [
                        'key' => $instance->key(),
                        'value' => $instance->value(),
                        'type' => $instance->type(),
                    ];
                } catch (Throwable $e) {
                    return null;
                }
            })
            ->filter()
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
        return (new Composer)->dependencies();
    }
}
