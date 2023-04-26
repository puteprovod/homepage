<?php

namespace App\Components\Currency;

class ImportCryptoCurrenciesClient extends ImportCurrenciesFromAPIClient
{
    public string $code = 'cmc';
    protected array $config = [
        // Base URI is used with relative requests
        'base_uri' => 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest',
        // You can set any number of default request options.
        'timeout' => 2.0,
        'verify' => false,
        'headers' => [
            'X-CMC_PRO_API_KEY' => '1fcb04fe-57d7-43f5-85d1-1ba81f8bf32e',
            'Accept' => '*/*'
        ]
    ];

}
