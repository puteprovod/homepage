<?php

namespace App\Clients\Currency;

class ImportCryptoCurrenciesClient extends ImportCurrenciesFromAPIClient
{
    protected string $code = 'cmc';
    public function getExchanges(): array
    {
        $exchangeArray = [];
        $response = $this->client->get('');
        $response = json_decode($response->getBody(), 'true');
        foreach ($response['data'] as $item) {
            $exchangeArray[$item['symbol']] = $item['quote']['USD']['price'];
        }
        return $exchangeArray;
    }
}
