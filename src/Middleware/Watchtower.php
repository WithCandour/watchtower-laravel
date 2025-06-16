<?php

namespace Watchtower\WatchtowerLaravel\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Watchtower\WatchtowerLaravel\Facades\WatchtowerLaravel;

class Watchtower
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Config::get('watchtower-laravel.enabled')) return $next($request);

        if ($request->method() !== 'GET') return $next($request);

        $pollId = $request->header('X-Watchtower-Poll-Id');

        if (!$pollId) return $next($request);

        $response = $next($request);

        Artisan::call('watchtower:ping', [
            'pollId' => $pollId,
        ]);

        return $response;
    }
}