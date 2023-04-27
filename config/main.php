<?php

return [
    'currency' => [
        'api_clients' => [
            'cbr' => [
                'config' => [
                    'base_uri' => 'https://www.cbr-xml-daily.ru/daily.xml',
                    'timeout' => 2.0,
                    'verify' => false
                ],
                'cache_timeout' => 60
            ],
            'cmc' => [
                'config' => [
                    'base_uri' => 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest',
                    'timeout' => 2.0,
                    'verify' => false,
                    'headers' => [
                        'X-CMC_PRO_API_KEY' => '1fcb04fe-57d7-43f5-85d1-1ba81f8bf32e',
                        'Accept' => '*/*'
                    ]
                ],
                'cache_timeout' => 15
            ],
        ]
    ]
];
