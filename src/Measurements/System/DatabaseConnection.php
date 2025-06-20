<?php

namespace Watchtower\WatchtowerLaravel\Measurements\System;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\DB;

class DatabaseConnection extends Measurement
{
    public function key(): string
    {
        return 'system.database.connection';
    }

    public function value(): ?string
    {
        try {
            DB::connection()->getPdo();
            return 'true';
        } catch (\Exception $e) {
            return 'false';
        }
    }

    public function type(): string
    {
        return Measurement::TYPE_BOOLEAN;
    }
}
