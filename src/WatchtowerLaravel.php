<?php

namespace Watchtower\WatchtowerLaravel;

use Illuminate\Support\Collection;
use Watchtower\WatchtowerLaravel\Measurements\PHP;
use Watchtower\WatchtowerLaravel\Measurements\Git;

class WatchtowerLaravel
{
    public function measurements(): array
    {
        return Collection::make([
            PHP\Version::class,
            PHP\MemoryLimit::class,

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
        // TODO: Add dependencies
        return [];
    }
}
