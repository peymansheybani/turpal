<?php

namespace App\Services\V1;

use App\Suppliers\Concerns\SupplierAggregator;

class TourService
{
    public function __construct(private SupplierAggregator $supplierAggregator)
    {
    }

    public function list(array $params)
    {
        return $this->supplierAggregator->list($params['page'] ?? 1, $params['limit'] ?? 10);
    }
}
