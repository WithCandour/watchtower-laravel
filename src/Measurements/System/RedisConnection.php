<?php

namespace Watchtower\WatchtowerLaravel\Measurements\System;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;
use Illuminate\Support\Facades\Redis;

class RedisConnection extends Measurement
{
    public function key(): string
    {
        return 'system.redis.connection';
    }

    public function value(): ?string
    {
        try {
            Redis::ping();
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
