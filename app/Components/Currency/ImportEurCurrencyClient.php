<?php

namespace App\Components\Currency;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Psr\Http\Message\ResponseInterface;

class ImportEurCurrencyClient extends ImportCurrenciesFromAPIClient
{
    protected string $code = 'eur';
    public function getRaw(): ResponseInterface
    {
        return $this->client->get('');
    }
    public function getExchanges(): array
    {
        $response = $this->client->get('')->getBody();
        return ['EUR' => $response];
    }
}
