<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class BehindCount extends Measurement
{
    public function key(): string
    {
        return 'git.behind_count';
    }

    public function value(): ?string
    {
        $result = Process::run('git rev-list --count HEAD..@{u}');
        return trim($result->output());
    }

    public function type(): string
    {
        return Measurement::TYPE_INTEGER;
    }
}