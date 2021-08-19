<?php

namespace Nidavellir\CryptoCrawler\Pipelines;

use Nidavellir\CryptoCrawler\Pipes\CreateCoinMapper;
use Nidavellir\CryptoCrawler\Pipes\Poll;
use Nidavellir\CryptoCrawler\Pipes\SetCreateCoinUrl;

/**
 * Retrieves a crypto currency price data line.
 */
class CreateCoinPipeline
{
    public function __invoke()
    {
        return [
            SetCreateCoinUrl::class,
            Poll::class,
            CreateCoinMapper::class,
        ];
    }
}
