<?php

namespace Nidavellir\CryptoCrawler\Pipelines;

use Nidavellir\CryptoCrawler\Pipes\MarketCapCoinsRankMapper;
use Nidavellir\CryptoCrawler\Pipes\Poll;
use Nidavellir\CryptoCrawler\Pipes\SetMarketCapCoinsRankUrl;

/**
 * Gets all Gecko coins list using the API.
 */
class UpdateMarketCapCoinsRankPipeline
{
    public function __invoke()
    {
        return [
            SetMarketCapCoinsRankUrl::class,
            Poll::class,
            MarketCapCoinsRankMapper::class,
        ];
    }
}
