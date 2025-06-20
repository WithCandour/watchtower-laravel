<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class Author extends Measurement
{
    public function key(): string
    {
        return 'git.author';
    }

    public function value(): ?string
    {
        return Process::run('git log -1 --pretty=format:"%an (%ae)"')->output();
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}