<?php

namespace Watchtower\WatchtowerLaravel\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Watchtower\WatchtowerLaravel\Facades\WatchtowerLaravel;

class Watchtower
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->method() !== 'GET') return $next($request);

        $url = Config::get('watchtower-laravel.server_url');
        $id = $request->header('X-Watchtower-Poll-Id');
        $secret = Config::get('watchtower-laravel.secret');

        if (!$url || !$id || !$secret) return $next($request);

        if ($secret !== $request->header('X-Watchtower-Secret')) {
            return $next($request);
        }

        $response = $next($request);

        Http::asJson()
            ->withHeaders([
                'X-Watchtower-Secret' => $secret,
                'X-Watchtower-Poll-Id' => $id,
            ])->post($url, [
                'measurements' => WatchtowerLaravel::measurements(),
                'events' => WatchtowerLaravel::events(),
                'dependencies' => WatchtowerLaravel::dependencies(),
            ]);

        return $response;
    }
}
