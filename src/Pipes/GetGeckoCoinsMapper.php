<?php

namespace Nidavellir\CryptoCrawler\Pipes;

use Closure;
use Nidavellir\CryptoCube\Models\Coin;
use Nidavellir\CryptoCube\Models\GeckoCoin;

/**
 * Maps the gecko coins list into the database.
 *
 * Needs:
 * (mandatory) $data->response: Illuminate\Http\Client\Response
 *
 * Adds:
 * $data->coins: The created coin model instances.
 */
class GetGeckoCoinsMapper
{
    public function __construct()
    {
        //
    }

    public function handle($data, Closure $next)
    {
        $response = (object) $data->response->json();

        foreach ($response as $coin) {
            $coin = GeckoCoin::updateOrCreate(
                [
                    'coin_id' => $coin['id'],
                ],
                [
                    'symbol' => $coin['symbol'],
                    'name' => $coin['name'],
                ]
            );

            if (! isset($data->coins)) {
                $data->coins = [];
            }

            array_push($data->coins, $coin);
        }

        return $next($data);
    }
}
