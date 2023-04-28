<?php

namespace App\Providers;

use App\Components\Currency\ImportCbrCurrenciesClient;
use App\Components\Currency\ImportCryptoCurrenciesClient;
use App\Components\Currency\ImportEurCurrencyClient;
use App\Components\Currency\ImportUsdCurrencyClient;
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
