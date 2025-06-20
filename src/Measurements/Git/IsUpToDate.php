<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class IsUpToDate extends Measurement
{
    public function key(): string
    {
        return 'git.is_up_to_date';
    }

    public function value(): ?string
    {
        $result = Process::run('git status -uno');
        return str_contains($result->output(), 'up to date') ? 'true' : 'false';
    }

    public function type(): string
    {
        return Measurement::TYPE_BOOLEAN;
    }
}