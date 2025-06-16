<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class IsClean extends Measurement
{
    public function key(): string
    {
        return 'git.is_clean';
    }

    public function value(): ?string
    {
        $result = Process::run('git status --porcelain');
        return $result->output() === '' ? 'true' : 'false';
    }

    public function type(): string
    {
        return Measurement::TYPE_BOOLEAN;
    }
}