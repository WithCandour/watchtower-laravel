<?php

namespace Watchtower\WatchtowerLaravel\Measurements\System;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\DB;

class QueueJobCount extends Measurement
{
    public function key(): string
    {
        return 'system.queue.job_count';
    }

    public function value(): ?string
    {
        try {
            $pending = DB::table('jobs')->count();
            $failed = DB::table('failed_jobs')->count();

            return (string) ($pending + $failed);
        } catch (\Exception $e) {
            return '0';
        }
    }

    public function type(): string
    {
        return Measurement::TYPE_INTEGER;
    }
}
