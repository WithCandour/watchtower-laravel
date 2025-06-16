<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class ModifiedFiles extends Measurement
{
    public function key(): string
    {
        return 'git.modified_files';
    }

    public function value(): ?string
    {
        $result = Process::run('git status --porcelain | grep "^ M" | wc -l');
        return trim($result->output());
    }

    public function type(): string
    {
        return Measurement::TYPE_INTEGER;
    }
}