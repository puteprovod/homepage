<?php

namespace App\Components\Currency;

use GuzzleHttp\Client;

abstract class ImportCurrenciesFromAPIClient implements GettableAPI
{
    protected Client $client;
    protected array $config = [];
    protected string $code;
    protected string $config_path = 'main.currency.api_clients.';
    protected int $cacheTimeout;

    /**
     * @return int
     */
    public function getCacheTimeout(): int
    {
        return $this->cacheTimeout;
    }

    public function __construct()
    {
        $this->config = config($this->config_path . $this->code . '.config');
        $this->cacheTimeout = config($this->config_path . $this->code . '.cache_timeout');
        $this->client = new Client($this->config);
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
}
