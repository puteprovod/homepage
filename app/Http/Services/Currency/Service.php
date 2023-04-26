<?php

namespace App\Http\Services\Currency;


use App\Components\Currency\ImportCryptoCurrenciesClient;
use App\Components\Currency\ImportCurrenciesFromCbrClient;
use App\Http\Resources\Currency\CurrencyResource;
use App\Models\Currency;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
        $import = new ImportCryptoCurrenciesClient();
        $currencies = Currency::All()->where('source', $import->code);
        try {
            DB::beginTransaction();
            $import = new ImportCryptoCurrenciesClient();
            $response = $import->get();
            $response = json_decode($response->getBody(), 'true');
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
        } catch (GuzzleException $e) {
            DB::rollBack();
            $errorMessage = $errorMessage . "Ошибка обращения guzzle к серверу Coinmarketcap.";
        }
        return ($errorMessage);
    }

    public static function refreshCurrenciesFromAPI(): string
    {
        $errorMessage = '';
        $import = new ImportCurrenciesFromCbrClient();
        $currencies = Currency::All()->where('source', $import->code);
        try {
            DB::beginTransaction();
            $response = $import->get();
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
            $errorMessage = 'Ошибка обращения к серверу ЦБ РФ.';
        } catch (GuzzleException $e) {
            DB::rollBack();
            $errorMessage = 'Ошибка обращения guzzle к серверу ЦБ РФ.';
        }

        return ($errorMessage);
    }
}
