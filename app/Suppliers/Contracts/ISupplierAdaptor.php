<?php

namespace App\Suppliers\Contracts;

interface ISupplierAdaptor
{
    public function list(int $page = 1, int $limit = 10): array;

    public function detail(int|string $id): array;

    public function getPrice(int|string $id, int $page = 1, int $limit = 10): array;

    public function availability(int|string $id): array;
}
