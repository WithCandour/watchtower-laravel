<?php

namespace Watchtower\WatchtowerLaravel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Watchtower\WatchtowerLaravel\Facades\WatchtowerLaravel;

class Ping extends Command
{
    public $signature = 'watchtower:ping {pollId}';

    public $description = 'Ping the Watchtower server';

    public function handle(): int
    {
        $url = Config::get('watchtower-laravel.server_url');
        $secret = Config::get('watchtower-laravel.secret');

        if (!$url || !$secret) {
            $this->error('Server URL or secret not set');

            return self::FAILURE;
        }

        $res = Http::asJson()
            ->withHeaders([
                'X-Watchtower-Secret' => $secret,
                'X-Watchtower-Poll-Id' => $this->argument('pollId'),
            ])->post($url, [
                'measurements' => WatchtowerLaravel::measurements(),
                'events' => WatchtowerLaravel::events(),
                'dependencies' => WatchtowerLaravel::dependencies(),
            ]);

        if ($res->successful()) {
            $this->info('Pinged Watchtower server');

            return self::SUCCESS;
        }

        $this->error('Failed to ping Watchtower server');
        $this->error('Status: ' . $res->status());

        return self::FAILURE;
    }
}
