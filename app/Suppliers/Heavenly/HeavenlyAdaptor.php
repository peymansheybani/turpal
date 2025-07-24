<?php

namespace App\Suppliers\Heavenly;

use App\Suppliers\Contracts\ISupplierAdaptor;
use App\Suppliers\Dto\SupplierNormalizeDto;

class HeavenlyAdaptor implements ISupplierAdaptor
{

    public function __construct(private Heavenly $supplier)
    {
    }

    public function list(int $page = 1, int $limit = 10): array
    {
        $list = $this->supplier->list($page, $limit);

        $t =  collect($list)->map(function ($item) {
            return app(SupplierNormalizeDto::class, [
                "id" => $item['id'],
                "title" => $item['title'],
                "description" => $item['excerpt'],
                "city" => $item['city'],
                "country" => $item['country'],
                "price" => $this->getPrice($item['id'])['price'] ?? "",
            ]);
        });

        return $t->all();
    }

    public function detail(int|string $id): array
    {
        return $this->supplier->detail($id);
    }

    public function getPrice(int|string $id, int $page = 1, int $limit = 10): array
    {
        return $this->supplier->getPrice($id, $page, $limit);
    }

    public function availability(int|string $id): array
    {
        return $this->supplier->availability($id);
    }
}
