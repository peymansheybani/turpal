<?php

namespace App\Suppliers;

use App\Suppliers\Contracts\ISupplier;
use App\Suppliers\Contracts\ISupplierAdaptor;
use App\Suppliers\Heavenly\Heavenly;
use App\Suppliers\Heavenly\HeavenlyAdaptor;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Manager;
use Illuminate\Support\Str;

class SupplierManager extends Manager
{

    protected function createDriver($driver)
    {
        $method = 'create'.Str::studly($driver).'Driver';

        if (method_exists($this, $method)) {
            return $this->$method(config('supplier.' . $driver));
        }

        throw new InvalidArgumentException("Driver [$driver] not supported.");
    }

    public function getDefaultDriver()
    {
        throw new InvalidArgumentException(sprintf(
            'Unable to resolve NULL driver for [%s].', static::class
        ));
    }

    public function createHeavenlyDriver(array $config) : ISupplierAdaptor
    {
        $supplier = app(Heavenly::class, [
            'config' => $config,
        ]);

        return app(HeavenlyAdaptor::class, [
            'supplier' => $supplier,
        ]);
    }

    public function createMajestyDriver(array $config) : ISupplierAdaptor
    {
        // TODO add majesty supplier
    }
}
