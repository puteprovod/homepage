<?php

namespace App\Models;

use App\Components\ImportCurrenciesClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Currency extends Model
{
    protected $table = 'currencies';
    protected $guarded = [];
    use HasFactory;

    public static function refreshFromApi()
    {
        $errorMessage = '';
        $currencies = Currency::All();
        try {
            DB::beginTransaction();
        // LOAD CURRENCIES PRICES
        $import = new ImportCurrenciesClient();
        //$response = $import->client->request('GET', 'scripts/XML_daily.asp');
        $response = $import->client->request('GET', 'daily.xml');
        $xmlObject = simplexml_load_string($response->getBody());
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);
        $phpArray = $phpArray['Valute'];
        foreach ($phpArray as $item) {
            $currency = $currencies->where('title', $item['CharCode'])->where('source', 'cbr')->first();
            if ($currency) {
                // UPDATE EXCHANGE RATE FROM API
                $currency->update(['exchange_rate' => str_replace(",", ".", $item['Value']) / $item['Nominal']]);
            }
        }
            DB::commit();
        } catch (\Exception $exception1) {
            DB::rollBack();
            $errorMessage='Ошибка обращения к серверу ЦБ РФ. ';
        }
        // LOAD CRYPTOCURRENCIES PRICES
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
            $currency = $currencies->where('title', $item['symbol'])->where('source', 'cmc')->first();
            if ($currency) {
                // UPDATE EXCHANGE RATE FROM API
                $currency->update(['exchange_rate' => $price]);
            }
        }
            DB::commit();
        } catch (\Exception $exception2) {
            DB::rollBack();
            $errorMessage=$errorMessage."Ошибка обращения к серверу Coinmarketcap.";
        }
        return ($errorMessage);
    }

    public function accounts(){
        return $this->hasMany(Account::Class,'currency_id', 'id');
    }
}
