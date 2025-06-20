<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class AheadCount extends Measurement
{
    public function key(): string
    {
        return 'git.ahead_count';
    }

    public function value(): ?string
    {
        $result = Process::run('git rev-list --count @{u}..HEAD');
        return trim($result->output());
    }

    public function type(): string
    {
        return Measurement::TYPE_INTEGER;
    }
}