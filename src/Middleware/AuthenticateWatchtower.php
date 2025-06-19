<?php

namespace Watchtower\WatchtowerLaravel\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Watchtower\WatchtowerLaravel\Facades\WatchtowerLaravel;

class AuthenticateWatchtower
{
    public function handle(Request $request, Closure $next): Response
    {
        $secret = config('watchtower-laravel.secret');
        $project_id = $request->header('X-Watchtower-Project-Id');

        if (! $secret) {
            return response()->json(['error' => 'Watchtower secret not configured'], 500);
        }

        $headerSecret = $request->header('X-Watchtower-Secret');

        if (! $headerSecret || $headerSecret !== $secret) {
            return response()->json(['error' => 'Invalid Watchtower secret'], 401);
        }

        $response = $next($request);

        if ($request->isMethod('GET')) {
            $measurements = WatchtowerLaravel::measurements();
            $this->sendMeasurements($measurements, $project_id);
        }

        return $response;
    }

    private function sendMeasurements(array $measurements, string $project_id): void
    {
        $serverUrl = config('watchtower-laravel.server_url');

        if (! $serverUrl) {
            return;
        }

        Http::post($serverUrl.'/api/measurements', [
            'measurements' => $measurements,
            'project_id' => $project_id,
        ]);
    }
}
