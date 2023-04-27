<?php

namespace App\Components\Currency;

interface GettableAPI
{
    public function getExchanges(): array;

    public function getCacheTimeout(): int;
    public function getCode(): string;

}
