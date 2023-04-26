<?php

namespace App\Components\Currency;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

abstract class ImportCurrenciesFromAPIClient
{
    protected Client $client;
    protected array $config = [];
    public string $code;

    public function __construct()
    {
        $this->client = new Client($this->config);
    }

    /**
     * @throws GuzzleException
     */
    public function get(): \Psr\Http\Message\ResponseInterface
    {
        return $this->client->get('');
    }
}
