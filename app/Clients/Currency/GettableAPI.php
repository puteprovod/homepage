<?php

namespace App\Clients\Currency;

interface GettableAPI
{
    public function getExchanges(): array;

    public function getCacheTimeout(): int;
    public function getCode(): string;

}
