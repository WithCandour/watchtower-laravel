<?php

namespace Watchtower\WatchtowerLaravel\Dependencies;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class Composer
{
    protected function locked(): array
    {
        $file = base_path('composer.lock');

        if (!File::exists($file)) {
            return [];
        }

        return json_decode(File::get($file), true)['packages'] ?? [];
    }

    protected function required(): array
    {
        $file = base_path('composer.json');

        if (!File::exists($file)) {
            return [];
        }

        return json_decode(File::get($file), true)['require'] ?? [];
    }

    public function dependencies(): array
    {
        $locked = Collection::make($this->locked());

        return Collection::make($this->required())
            ->filter()
            ->map(function (string $version, string $name) use ($locked) {
                $installed = $locked->first(
                    fn (array $p) => $p['name'] === $name
                );

                return [
                    'type' => 'composer',
                    'name' => $name,
                    'version' => $installed['version'] ?? $version,
                    'constraint' => $version,
                ];
            })
            ->toArray();
    }
}