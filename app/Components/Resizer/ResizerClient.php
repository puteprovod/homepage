<?php

namespace App\Components\Resizer;

use GuzzleHttp\Client;

class ResizerClient
{
    // RESIZER CLIENT TEMPLATE
    /**
     * @param $client
     */
    public Client $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:5000',
            'timeout'  => 2.0,
            'verify' => false
        ]);
    }

}
