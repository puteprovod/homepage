<?php

namespace App\Providers;

use App\Clients\Currency\ImportCbrCurrenciesClient;
use App\Clients\Currency\ImportCryptoCurrenciesClient;
use App\Clients\Currency\ImportEurCurrencyClient;
use App\Clients\Currency\ImportUsdCurrencyClient;
use App\Http\Services\Currency\Service;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // CURRENCY Exchange rates reload Service
        $this->app->singleton(Service::class, function () {
            return new Service(...
                [
                    new ImportCryptoCurrenciesClient(),
                    new ImportCbrCurrenciesClient(),
                    new ImportUsdCurrencyClient(),
                    new ImportEurCurrencyClient()
                ]
            );
        });


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }
}
