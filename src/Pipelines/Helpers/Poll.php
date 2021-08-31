<?php

namespace Nidavellir\CryptoCrawler\Pipelines\Helpers;

use Closure;
use Illuminate\Support\Facades\Http;

/**
 * Fetches an URL
 *
 * Needs:
 * (mandatory) $data->url: The url that should will be polled (string)
 * (optional)  $data->method: GET or POST (string) (default=get)
 * (optional)  $data->headers: Additional headers (array)
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
        $http = new Http();

        if ($data->headers) {
            $http::withHeaders($data->headers);
        }

        $response = $http::{strtolower($method)}($data->url);
        data_set($data, 'response', $response);

        return $next($data);
    }
}
