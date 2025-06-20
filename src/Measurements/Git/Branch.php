<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class Branch extends Measurement
{
    public function key(): string
    {
        return 'git.branch';
    }

    public function value(): ?string
    {
        return Process::run('git branch --show-current')->output();
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}