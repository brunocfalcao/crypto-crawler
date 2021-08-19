<?php

namespace Nidavellir\CryptoCrawler\Pipes;

use Closure;
use Nidavellir\CryptoCube\Models\Coin;

/**
 * Maps a create coin fetch into the database.
 *
 * Needs:
 * (mandatory) $data->response: Illuminate\Http\Client\Response
 *
 * Adds:
 * $data->coin: The created coin model instance.
 */
class CreateCoinMapper
{
    public function __construct()
    {
        //
    }

    public function handle($data, Closure $next)
    {
        $response = (object) $data->response->json();

        if (! $response->id) {
            throw new \Exception("Coin ID not found ({$data->coin})");
        }

        //Populate the model instance.
        $coin = new Coin();

        $coin = Coin::updateOrCreate(
            [
                'coin_id' => $response->id, ],
            [
                'symbol' => $response->symbol,
                'name' => $response->name,
                'description' => $response->description['en'],
                'homepage_url' => $response->links['homepage'][0],
                'twitter_username' => $response->links['twitter_screen_name'],
                'subreddit_url' => $response->links['subreddit_url'],
                'image_url' => $response->image['large'],
                'genesis_date' => $response->genesis_date,
                'alexa_rank' => $response->public_interest_stats['alexa_rank'],
            ]
        );

        data_set($data, 'coin', $coin);

        return $next($data);
    }
}
