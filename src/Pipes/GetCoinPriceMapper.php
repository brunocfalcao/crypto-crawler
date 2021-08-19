<?php

namespace Nidavellir\CryptoCrawler\Pipes;

use Closure;
use Nidavellir\CryptoCube\Models\Coin;
use Nidavellir\CryptoCube\Models\CoinPrice;

/**
 * Maps a simple price fetch into the database.
 *
 * Needs:
 * (mandatory) $data->response: Illuminate\Http\Client\Response (array of)
 *
 * Adds:
 * $data->prices: The created coin prices model instances (array).
 */
class GetCoinPriceMapper
{
    public function __construct()
    {
        //
    }

    public function handle($data, Closure $next)
    {
        $response = $data->response->json();

        //Populate the price model instances.
        foreach ($response as $price) {
            $price = (object) $price;

            if (Coin::firstWhere('coin_id', $price->id)) {
                $model = CoinPrice::create([
                    'coin_id' => Coin::firstWhere('coin_id', $price->id)->id,
                    'current_price' => round($price->current_price, 4),
                    'market_cap' => $price->market_cap,
                    'market_cap_rank' => $price->market_cap_rank,
                    'total_volume' => $price->total_volume,
                    'high_24h' => round($price->high_24h, 4),
                    'low_24h' => round($price->low_24h, 4),
                    'price_change_24h' => round($price->price_change_24h, 4),
                    'price_change_percentage_24h' => round($price->price_change_percentage_24h, 4),
                    'market_cap_change_24h' => $price->market_cap_change_24h,
                    'market_cap_change_percentage_24h' => round($price->market_cap_change_percentage_24h, 4),
                    'circulating_supply' => round($price->circulating_supply, 4),
                    'total_supply' => round($price->total_supply, 4),
                    'max_supply' => round($price->max_supply, 4),
                    'ath' => round($price->ath, 4),
                    'ath_change_percentage' => round($price->ath_change_percentage, 4),
                    'ath_date' => $price->ath_date,
                    'atl' => round($price->atl, 4),
                    'atl_change_percentage' => round($price->atl_change_percentage, 4),
                    'price_change_percentage_1h' => round($price->price_change_percentage_1h_in_currency, 4),
                    'atl_date' => $price->atl_date,
                    'last_updated' => $price->last_updated,
                ]);

                if (! isset($data->prices)) {
                    $data->prices = [];
                }

                array_push($data->prices, $model);
            }
        }

        return $next($data);
    }
}
