<?php

namespace Watchtower\WatchtowerLaravel\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Watchtower\WatchtowerLaravel\Facades\WatchtowerLaravel;

class Watchtower
{
    public function handle(Request $request, Closure $next): Response
    {
        $secret = config('watchtower-laravel.secret');
        $headerSecret = $request->header('X-Watchtower-Secret');

        if (! $request->isMethod('GET')) {
            return $next($request);
        }
        if (! $secret) {
            return $next($request);
        }
        if (! $headerSecret || $headerSecret !== $secret) {
            return $next($request);
        }

        $response = $next($request);

        $measurements = WatchtowerLaravel::measurements();
        $events = WatchtowerLaravel::events();
        $dependencies = WatchtowerLaravel::dependencies();
        $this->sendPayload($measurements, $events, $dependencies, $secret);

        return $response;
    }

    protected function sendPayload(array $measurements, array $events, array $dependencies, string $project_id): void
    {
        $serverUrl = config('watchtower-laravel.server_url');

        if (! $serverUrl) {
            return;
        }

        Http::post($serverUrl.'/api/measurements', [
            'measurements' => $measurements,
            'events' => $events,
            'dependencies' => $dependencies,
            'project_id' => $project_id,
        ]);
    }
}
