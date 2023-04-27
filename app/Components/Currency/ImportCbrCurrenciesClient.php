<?php

namespace App\Components\Currency;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Psr\Http\Message\ResponseInterface;

class ImportCbrCurrenciesClient extends ImportCurrenciesFromAPIClient
{
    protected string $code = 'cbr';
    public function getRaw(): ResponseInterface
    {
        return $this->client->get('');
    }
    public function getExchanges(): array
    {
        $exchangeArray = [];
        $response = $this->client->get('');
        $xmlObject = simplexml_load_string($response->getBody());
        $response = json_encode($xmlObject);
        $response = json_decode($response, true);
        foreach ($response['Valute'] as $item) {
            if ($item['Nominal'])
                $exchangeArray[$item['CharCode']] = str_replace(",", ".", $item['Value']) / $item['Nominal'];
        }
        return $exchangeArray;
    }
}
