<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class Origin extends Measurement
{
    public function key(): string
    {
        return 'git.origin';
    }

    public function value(): ?string
    {
        return Process::run('git remote get-url origin')->output();
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}