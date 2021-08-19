<?php

namespace Nidavellir\CryptoCrawler\Pipelines;

use Nidavellir\CryptoCrawler\Pipes\GetCoinPriceMapper;
use Nidavellir\CryptoCrawler\Pipes\Poll;
use Nidavellir\CryptoCrawler\Pipes\SetGetCoinPriceUrl;

/**
 * Retrieves a crypto currency price data line.
 */
class GetCoinPricePipeline
{
    public function __invoke()
    {
        return [
            SetGetCoinPriceUrl::class,
            Poll::class,
            GetCoinPriceMapper::class,
        ];
    }
}
