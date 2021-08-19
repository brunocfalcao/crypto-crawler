<?php

namespace Nidavellir\CryptoCrawler\Pipelines;

use Nidavellir\CryptoCrawler\Pipes\GetCoinPriceMapper;
use Nidavellir\CryptoCrawler\Pipes\Poll;
use Nidavellir\CryptoCrawler\Pipes\SetGetCoinPriceUrl;

/**
 * Gets all Gecko coins list using the API.
 */
class GetGeckoCoinsListPipeline
{
    public function __invoke()
    {
        return [
            Poll::class,
        ];
    }
}
