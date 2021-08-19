<?php

namespace Nidavellir\CryptoCrawler\Pipes;

use Closure;

/**
 * Sets the get gecko coins list URL.
 *
 * Needs:
 * Nothing
 *
 * Adds:
 * $data->url: The URL to be called on the next pipe.
 */
class SetGetGeckoCoinsUrl
{
    public function __construct()
    {
        //
    }

    public function handle($data, Closure $next)
    {
        data_set(
            $data,
            'url',
            'https://api.coingecko.com/api/v3/coins/list?include_platform=false'
        );

        return $next($data);
    }
}
