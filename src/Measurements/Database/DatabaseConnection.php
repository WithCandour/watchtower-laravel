<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Database;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\DB;

class Connection extends Measurement
{
    public function key(): string
    {
        return 'database.connection';
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
