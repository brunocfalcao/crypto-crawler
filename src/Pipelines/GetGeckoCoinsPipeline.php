<?php

namespace Nidavellir\CryptoCrawler\Pipelines;

use Nidavellir\CryptoCrawler\Pipes\GetGeckoCoinsMapper;
use Nidavellir\CryptoCrawler\Pipes\Poll;
use Nidavellir\CryptoCrawler\Pipes\SetGetGeckoCoinsUrl;

/**
 * Gets all Gecko coins list using the API.
 */
class GetGeckoCoinsPipeline
{
    public function __invoke()
    {
        return [
            SetGetGeckoCoinsUrl::class,
            Poll::class,
            GetGeckoCoinsMapper::class,
        ];
    }
}
