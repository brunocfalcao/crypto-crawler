<?php

namespace Nidavellir\CryptoCrawler\Pipes;

use Closure;

/**
 * Sets the simple price URL for creating a new coin in Nidavellir.
 *
 * Needs:
 * (mandatory) $data->coin: coin id.
 *
 * Adds:
 * $data->url: The URL to be called on the next pipe.
 */
class SetCreateCoinUrl
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
            "https://api.coingecko.com/api/v3/coins/{$data->coin}?localization=false&tickers=false&market_data=true&community_data=true&developer_data=true&sparkline=false"
        );

        return $next($data);
    }
}
