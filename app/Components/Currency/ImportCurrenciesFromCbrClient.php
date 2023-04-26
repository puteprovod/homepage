<?php

namespace App\Components\Currency;

class ImportCurrenciesFromCbrClient extends ImportCurrenciesFromAPIClient
{
    public string $code = 'cbr';
    protected array $config = [
        // Base URI is used with relative requests
        //'base_uri' => 'https://www.cbr.ru/scripts/XML_daily.asp',
        'base_uri' => 'https://www.cbr-xml-daily.ru/daily.xml',
        // You can set any number of default request options.
        'timeout' => 2.0,
        'verify' => false
    ];

}
