<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class GitVersion extends Measurement
{
    public function key(): string
    {
        return 'git.version';
    }

    public function value(): ?string
    {
        $result = Process::run('git --version');
        $output = trim($result->output());

        // Extract version number from "git version 2.39.2" format
        if (preg_match('/git version (\d+\.\d+\.\d+)/', $output, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}