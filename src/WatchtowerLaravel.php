<?php

namespace Watchtower\WatchtowerLaravel;

use Illuminate\Support\Collection;
use Watchtower\WatchtowerLaravel\Measurements\PHP;

class WatchtowerLaravel {
    public function measurements(): array
    {
        return Collection::make([
                PHP\Version::class,
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
}
