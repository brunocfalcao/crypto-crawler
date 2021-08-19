<?php

namespace Nidavellir\CryptoCrawler\Pipes;

use Closure;
use Illuminate\Support\Facades\Http;

/**
 * Fetches a crypto currency data line via an HTTP get request.
 *
 * Needs:
 * (mandatory) $data->url: The url that should will be polled.
 * (optional)  $data->method: GET or POST.
 *
 * Adds:
 * $data->response: Illuminate\Http\Client\Response
 * https://laravel.com/docs/8.x/http-client#making-requests
 */
class Poll
{
    public function __construct()
    {
        //
    }

    public function handle($data, Closure $next)
    {
        $method = $data->method ?? 'get';

        $response = Http::{$method}($data->url);

        if (! $response->ok()) {
            if ($response->json()['error']) {
                throw new \Exception("Fetch error - {$response->json()['error']}");
            } else {
                throw new \Exception('Fetch error (unknown error message)');
            }
            return;
        }

        data_set($data, 'response', $response);

        return $next($data);
    }
}
