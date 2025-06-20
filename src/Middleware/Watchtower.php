<?php

namespace Watchtower\WatchtowerLaravel\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Watchtower\WatchtowerLaravel\Facades\WatchtowerLaravel;

class Watchtower
{
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Watchtower middleware: Request received', [
            'method' => $request->method(),
            'url' => $request->url(),
            'headers' => $request->headers->all(),
            'middleware_registered' => true,
        ]);

        if ($request->method() !== 'GET') {
            Log::info('Watchtower middleware: Skipping non-GET request', [
                'method' => $request->method(),
            ]);
            return $next($request);
        }

        $url = Config::get('watchtower-laravel.server_url');
        $id = $request->header('X-Watchtower-Poll-Id');
        $secret = Config::get('watchtower-laravel.secret');

        Log::info('Watchtower middleware: Checking configuration', [
            'url_configured' => !empty($url),
            'id_present' => !empty($id),
            'secret_configured' => !empty($secret),
        ]);

        if (!$url || !$id || !$secret) {
            Log::info('Watchtower middleware: Missing required configuration', [
                'url' => $url,
                'id' => $id,
                'secret_configured' => !empty($secret),
            ]);
            return $next($request);
        }

        if ($secret !== $request->header('X-Watchtower-Secret')) {
            Log::info('Watchtower middleware: Secret mismatch', [
                'expected_secret' => $secret,
                'received_secret' => $request->header('X-Watchtower-Secret'),
            ]);
            return $next($request);
        }

        $response = $next($request);

        try {
            $payload = [
                'measurements' => WatchtowerLaravel::measurements(),
                'events' => WatchtowerLaravel::events(),
                'dependencies' => WatchtowerLaravel::dependencies(),
            ];

            Log::info('Watchtower middleware: Sending data to server', [
                'url' => $url,
                'poll_id' => $id,
                'payload_size' => json_encode($payload),
            ]);

            $httpResponse = Http::asJson()
                ->withHeaders([
                    'X-Watchtower-Secret' => $secret,
                    'X-Watchtower-Poll-Id' => $id,
                ])->post($url, $payload);

            if (!$httpResponse->successful()) {
                Log::error('Watchtower middleware: HTTP request failed', [
                    'status_code' => $httpResponse->status(),
                    'response_body' => $httpResponse->body(),
                    'url' => $url,
                    'poll_id' => $id,
                ]);
            } else {
                Log::info('Watchtower middleware: Data sent successfully', [
                    'status_code' => $httpResponse->status(),
                    'poll_id' => $id,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Watchtower middleware: Exception occurred while sending data', [
                'exception' => $e->getMessage(),
                'exception_class' => get_class($e),
                'trace' => $e->getTraceAsString(),
                'url' => $url,
                'poll_id' => $id,
            ]);
        }

        return $response;
    }
}
