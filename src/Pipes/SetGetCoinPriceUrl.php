<?php

namespace Nidavellir\CryptoCrawler\Pipes;

use Closure;

/**
 * Sets the simple price URL.
 *
 * Needs:
 * (mandatory) $data->coins: coin ids, comma separated.
 *
 * Adds:
 * $data->url: The URL to be called on the next pipe.
 */
class SetGetCoinPriceUrl
{
    public function __construct()
    {
        //
    }

    public function handle($data, Closure $next)
    {
        $coins = urlencode($data->coins);

        data_set(
            $data,
            'url',
            "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$coins}&sparkline=false&price_change_percentage=1h"
        );

        return $next($data);
    }
}
