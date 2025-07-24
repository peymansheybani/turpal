<?php

namespace App\Suppliers;

use App\Suppliers\Concerns\SupplierAggregator;
use Illuminate\Support\ServiceProvider;

class SupplierServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('supplier.manager', function ($app) {
            return new SupplierManager($app);
        });
        $this->app->bind(SupplierAggregator::class, function ($app) {
            return new SupplierAggregator(config('supplier'));
        });
    }

    public function boot()
    {

    }
}
