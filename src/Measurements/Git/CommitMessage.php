<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class CommitMessage extends Measurement
{
    public function key(): string
    {
        return 'git.commit_message';
    }

    public function value(): ?string
    {
        return Process::run('git log -1 --pretty=format:"%s"')->output();
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}