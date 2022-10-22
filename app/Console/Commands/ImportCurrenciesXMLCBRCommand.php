<?php

namespace App\Console\Commands;

use App\Components\ImportCurrenciesClient;
use App\Models\Currency;
use Illuminate\Console\Command;

class ImportCurrenciesXMLCBRCommand extends Command
{

    protected $signature = 'import:currenciescbr';

    protected $description = 'Import currencies from CBR Website';

    public function handle()
    {
                $import = new ImportCurrenciesClient();
        $response = $import->client->request('GET', 'scripts/XML_daily.asp');
        $xmlObject = simplexml_load_string($response->getBody());
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);
        $phpArray = $phpArray['Valute'];
        foreach ($phpArray as $valute){
            Currency::firstOrCreate(
                [
                    'title' => $valute['CharCode'],
                ],
                [
                    'title' => $valute['CharCode'],
                    'long_title' => $valute['Name'],
                    'exchange_rate' => str_replace(",",".",$valute['Value'])/$valute['Nominal'],
                    'source' => 'cbr',
                    'apilink' => 'https://www.cbr.ru/scripts/XML_daily.asp',
                ]
            );
        }
        echo 'SUCCESS';
        return Command::SUCCESS;
    }
}
