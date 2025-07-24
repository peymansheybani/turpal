<?php

namespace App\Suppliers\Concerns;

use App\Facades\Supplier;
use App\Suppliers\Contracts\ISupplierAdaptor;

class SupplierAggregator implements ISupplierAdaptor
{
    public function __construct(private array $suppliers)
    {
    }

    public function list(int $page = 1, int $limit = 10): array
    {
        $results = [];

        collect($this->suppliers)->each(function ($supplier, $key) use (&$results, $page, $limit) {
            $results = array_merge($results, Supplier::driver($key)->list($page, $limit));
        });

        return $results;
    }

    public function detail(int|string $id): array
    {
        // TODO: Implement detail() method.
    }

    public function getPrice(int|string $id, int $page = 1, int $limit = 10): array
    {
        // TODO: Implement getPrice() method.
    }

    public function availability(int|string $id): array
    {
        // TODO: Implement availability() method.
    }
}
