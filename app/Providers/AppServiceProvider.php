<?php

namespace App\Providers;

use App\Services\V1\TourService;
use App\Suppliers\Concerns\SupplierAggregator;
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
//        $this->app->bind(TourService::class,  function ($app) {
//            return new TourService(app(SupplierAggregator::class));
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
