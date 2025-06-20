<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class CommitHash extends Measurement
{
    public function key(): string
    {
        return 'git.commit_hash';
    }

    public function value(): ?string
    {
        return Process::run('git rev-parse HEAD')->output();
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}