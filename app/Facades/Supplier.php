<?php

namespace App\Facades;

use App\Suppliers\Contracts\ISupplierAdaptor;
use Illuminate\Support\Facades\Facade;

/**
 * @method static ISupplierAdaptor driver(string $supplier)
 */
class Supplier extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'supplier.manager';
    }
}
