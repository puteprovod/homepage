<?php

namespace App\Http\Services\Currency;


use App\Components\Currency\GettableAPI;
use App\Http\Resources\Currency\CurrencyResource;
use App\Models\Currency;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Service
{
    public array $currencies;
    public string $errorMessage;
    public function __construct(GettableAPI ...$importAPIs)
    {
        $response = $this->getActualCurrencyInfo(...$importAPIs);
        $this->currencies = $response['currencies'];
        $this->errorMessage = $response['errorMessage'];
    }

    private function getActualCurrencyInfo(GettableAPI ...$importAPIs): array
    {
        $errorMessage = '';
        $changedFlag = false;
        foreach ($importAPIs as $importAPI) {
            $hashName = 'importAPI_'.hash('md5',get_class($importAPI));
            if (Cache::missing($hashName)) {
                $errorMessage .= $this->getExchangeValuesFromAPI($importAPI);
                Cache::put($hashName, true, now()->addMinutes($importAPI->getCacheTimeout()));
                $changedFlag = true;
            }
        }
        if ($changedFlag){
            $currencies = Currency::All()->sortByDesc('priority');
            Cache::tags('accounts')->flush();
            Cache::put('currencyCache', [
                'currencies' => CurrencyResource::collection($currencies)->resolve(),
                'errorMessage' => $errorMessage
            ]);
        }
        return Cache::get('currencyCache');
    }

    private function getExchangeValuesFromAPI(GettableAPI $import): string
    {
        $errorMessage = '';
        $currencies = Currency::All()->where('source', $import->getCode());
        try {
            DB::beginTransaction();
            $exchangeArray = $import->getExchanges();
            foreach ($currencies as $currency) {
                if (isset($exchangeArray[$currency->title]))
                    $currency->update(['exchange_rate' => $exchangeArray[$currency->title]]);
            }
            DB::commit();
        } catch (\Exception $exception2) {
            DB::rollBack();
            $errorMessage = $errorMessage . "Ошибка клиента API " . (new \ReflectionClass($import))->getShortName();
        }
        return ($errorMessage);
    }
}
