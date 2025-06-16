<?php

namespace Watchtower\WatchtowerLaravel\Commands;

use Illuminate\Console\Command;

class WatchtowerLaravelCommand extends Command
{
    public $signature = 'watchtower-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
