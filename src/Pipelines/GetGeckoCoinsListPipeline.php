<?php

namespace Nidavellir\CryptoCrawler\Pipelines;

use Nidavellir\CryptoCrawler\Pipes\GetCoinPriceMapper;
use Nidavellir\CryptoCrawler\Pipes\Poll;
use Nidavellir\CryptoCrawler\Pipes\SetGetCoinPriceUrl;

/**
 * Gets all Gecko coins list using the API.
 */
class GetCoinPricePipeline
{
    public function __invoke()
    {
        return [
            SetGetGeckoCoinsListUrl::class,
            Poll::class,
            GetGeckoCoinsListMapper::class,
        ];
    }
}
