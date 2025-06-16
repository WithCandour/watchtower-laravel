<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;
use Watchtower\WatchtowerLaravel\Measurements\Measurement as Base;

abstract class Measurement extends Base
{
    protected function enabled(): bool
    {
        return Process::run('git status')->successful();
    }
}