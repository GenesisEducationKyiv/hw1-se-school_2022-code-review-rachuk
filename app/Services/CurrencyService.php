<?php

namespace App\Services;

use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CurrencyService
{
    /**
     * @return int|null
     * @throws \Exception
     */
    public function getBTCToUAH(): ?int
    {
        $client = new CoinGeckoClient();
        $rate = $client->simple()->getPrice('0x,bitcoin', 'uah');

        if (isset($rate['bitcoin']) && isset($rate['bitcoin']['uah'])) {
            return $rate['bitcoin']['uah'];
        }

        return null;
    }
}
