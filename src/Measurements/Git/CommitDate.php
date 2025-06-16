<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class CommitDate extends Measurement
{
    public function key(): string
    {
        return 'git.commit_date';
    }

    public function value(): ?string
    {
        return Process::run('git log -1 --pretty=format:"%ci"')->output();
    }

    public function type(): string
    {
        return Measurement::TYPE_DATE;
    }
}