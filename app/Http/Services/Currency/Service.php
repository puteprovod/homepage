<?php

namespace App\Http\Services\Currency;


use App\Components\ImportCurrenciesClient;
use App\Http\Resources\Currency\CurrencyResource;
use App\Models\Currency;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Service
{
    public static function getActualCurrencyInfo(){
        return Cache::remember('refreshCrypto', now()->addMinutes(10), function () {
            $errorMessage = self::refreshCrytpoFromAPI();
            if (Cache::missing('refreshCurrencies')) {
                $errorMessage .= self::refreshCurrenciesFromAPI();
                Cache::put('refreshCurrencies', true, now()->addMinutes(60));
            }
            $currencies = Currency::All()->sortByDesc('priority');
            Cache::tags('accounts')->flush();
            return [
                'currencies' => CurrencyResource::collection($currencies)->resolve(),
                'errorMessage' => $errorMessage
            ];
        });
    }
    public static function refreshCrytpoFromAPI(): string
    {
        $errorMessage = '';
        $currencies = Currency::All()->where('source', 'cmc');
        try {
            DB::beginTransaction();
            // LOAD CURRENCIES PRICES
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => '1fcb04fe-57d7-43f5-85d1-1ba81f8bf32e',
                'Accept' => '*/*'
            ])->acceptJson()->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest');
            $response = json_decode($response, 'true');
            $response = $response['data'];
            foreach ($response as $item) {
                $price = $item['quote']['USD']['price'];
                $currency = $currencies->where('title', $item['symbol'])->first();
                if ($currency) {
                    // UPDATE EXCHANGE RATE FROM API
                    $currency->update(['exchange_rate' => $price]);
                }
            }
            DB::commit();
        } catch (\Exception $exception2) {
            DB::rollBack();
            $errorMessage = $errorMessage . "Ошибка обращения к серверу Coinmarketcap.";
        }

        return ($errorMessage);
    }

    public static function refreshCurrenciesFromAPI(): string
    {
        $errorMessage = '';
        $currencies = Currency::All()->where('source', 'cbr');
        try {
            DB::beginTransaction();
            $import = new ImportCurrenciesClient();
            //$response = $import->client->request('GET', 'scripts/XML_daily.asp'); - ЦБ РФ
            $response = $import->client->request('GET', 'daily.xml');
            $xmlObject = simplexml_load_string($response->getBody());
            $json = json_encode($xmlObject);
            $phpArray = json_decode($json, true);
            $phpArray = $phpArray['Valute'];
            foreach ($phpArray as $item) {
                $currency = $currencies->where('title', $item['CharCode'])->first();
                if ($currency) {
                    // UPDATE EXCHANGE RATE FROM API
                    $currency->update(['exchange_rate' => str_replace(",", ".", $item['Value']) / $item['Nominal']]);
                }
            }
            DB::commit();
        } catch (\Exception $exception1) {
            DB::rollBack();
            $errorMessage = 'Ошибка обращения к серверу ЦБ РФ. ';
        }

        return ($errorMessage);
    }
}
